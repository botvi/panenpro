<?php

namespace App\Http\Controllers\asisten;

use App\Models\Krani;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KraniController extends Controller
{
  public function index()
  {
    $krani = Krani::with('user')->where('asisten_id', auth()->user()->id)->get();
    return view('pageasisten.datakrani.index', compact('krani'));
  }

  public function create()
  {
    return view('pageasisten.datakrani.create');
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
      'role' => 'krani'
    ]); 

    // Buat kepala sekolah baru
    Krani::create([
      'asisten_id' => auth()->user()->id,
      'user_id' => $user->id,
      'nama' => $request->nama,
      'npk' => $request->npk,
    ]);

    Alert::success('Berhasil', 'Data Krani berhasil ditambahkan');
    return redirect()->route('datakrani.index');
  }

  public function show($id)
  {
    $krani = Krani::with('user')->findOrFail($id);
    return view('pageasisten.datakrani.show', compact('krani'));
  }

  public function edit($id)
  {
    $krani = Krani::with('user')->findOrFail($id);
    $user = User::find($krani->user_id);
    return view('pageasisten.datakrani.edit', compact('krani', 'user'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'npk' => 'required',
      'username' => 'required|unique:users,username,' . $request->user_id,
    ]);

    $krani = Krani::findOrFail($id);
    
    // Update data user
    $user = User::find($krani->user_id);
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
    $krani->update([
      'asisten_id' => auth()->user()->id,
      'nama' => $request->nama,
      'npk' => $request->npk,
    ]);

    Alert::success('Berhasil', 'Data Krani berhasil diperbarui');
    return redirect()->route('datakrani.index');
  }

  public function destroy($id)
  {
    $krani = Krani::findOrFail($id);
    $user = User::find($krani->user_id);
    
    $krani->delete();
    $user->delete();

    Alert::success('Berhasil', 'Data Krani berhasil dihapus');
    return redirect()->route('datakrani.index');
  }
}