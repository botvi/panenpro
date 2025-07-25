<?php

namespace App\Http\Controllers\asisten;

use App\Models\Mandor;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MandorController extends Controller
{
  public function index()
  {
    $mandor = Mandor::with('user')->get();
    return view('pageasisten.datamandor.index', compact('mandor'));
  }

  public function create()
  {
    return view('pageasisten.datamandor.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'npk' => 'required',
      'username' => 'required|unique:users',
      'password' => 'required|min:6|confirmed',
    ]);

    // Buat user baru
    $user = User::create([
      'nama' => $request->nama,
      'username' => $request->username,
      'password' => Hash::make($request->password),
      'role' => 'mandor'
    ]); 

    // Buat kepala sekolah baru
    Mandor::create([
      'user_id' => $user->id,
      'nama' => $request->nama,
      'npk' => $request->npk,
    ]);

    Alert::success('Berhasil', 'Data Mandor berhasil ditambahkan');
    return redirect()->route('datamandor.index');
  }

  public function show($id)
  {
    $mandor = Mandor::with('user')->findOrFail($id);
    return view('pageasisten.datamandor.show', compact('mandor'));
  }

  public function edit($id)
  {
    $mandor = Mandor::with('user')->findOrFail($id);
    $user = User::find($mandor->user_id);
    return view('pageasisten.datamandor.edit', compact('mandor', 'user'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'npk' => 'required',
      'username' => 'required|unique:users,username,' . $request->user_id,
    ]);

    $mandor = Mandor::findOrFail($id);
    
    // Update data user
    $user = User::find($mandor->user_id);
    $user->update([
      'nama' => $request->nama,
      'username' => $request->username,
    ]);

    // Update password jika diisi
    if ($request->filled('password')) {
      $user->update([
        'password' => Hash::make($request->password)
      ]);
    }

    // Update data wali kelas
    $mandor->update([
      'nama' => $request->nama,
      'npk' => $request->npk,
    ]);

    Alert::success('Berhasil', 'Data Mandor berhasil diperbarui');
    return redirect()->route('datamandor.index');
  }

  public function destroy($id)
  {
    $mandor = Mandor::findOrFail($id);
    $user = User::find($mandor->user_id);
    
    $mandor->delete();
    $user->delete();

    Alert::success('Berhasil', 'Data Mandor berhasil dihapus');
    return redirect()->route('datamandor.index');
  }
}