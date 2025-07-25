<?php

namespace App\Http\Controllers\mandor;

use App\Models\Pemanen;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PemanenController extends Controller
{
  public function index()
  {
    $pemanen = Pemanen::with('user')->where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.datapemanen.index', compact('pemanen'));
  }

  public function create()
  {
    return view('pagemandor.datapemanen.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'kode_panen' => 'required',
      'estate' => 'required',
      'npk' => 'required',
      'username' => 'required|unique:users,username',
      'password' => 'required|confirmed',
    ]);

    // Buat user baru
    $user = User::create([
      'nama' => $request->nama,
      'username' => $request->username,
      'password' => Hash::make($request->password),
      'role' => 'pemanen'
    ]); 

    // Buat pemanen baru
    Pemanen::create([
      'user_id' => $user->id,
      'nama' => $request->nama,
      'kode_panen' => $request->kode_panen,
      'estate' => $request->estate,
      'npk' => $request->npk,
      'mandor_id' => auth()->user()->id,
    ]);

    Alert::success('Berhasil', 'Data Pemanen berhasil ditambahkan');
    return redirect()->route('datapemanen.index');
  }

  public function show($id)
  {
    $pemanen = Pemanen::with('user')->findOrFail($id);
    return view('pagemandor.datapemanen.show', compact('pemanen'));
  }

  public function edit($id)
  {
    $pemanen = Pemanen::with('user')->findOrFail($id);
    $user = User::find($pemanen->user_id);
    return view('pagemandor.datapemanen.edit', compact('pemanen', 'user'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'kode_panen' => 'required',
      'estate' => 'required',
      'npk' => 'required',
      'username' => 'required|unique:users,username,' . $request->user_id,
    ]);

    $pemanen = Pemanen::findOrFail($id);
    
    // Update data user
    $user = User::find($pemanen->user_id);
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
    $pemanen->update([
      'nama' => $request->nama,
      'kode_panen' => $request->kode_panen,
      'estate' => $request->estate,
      'npk' => $request->npk,
      'mandor_id' => auth()->user()->id,
    ]);

    Alert::success('Berhasil', 'Data Pemanen berhasil diperbarui');
    return redirect()->route('datapemanen.index');
  }

  public function destroy($id)
  {
    $pemanen = Pemanen::findOrFail($id);
    $user = User::find($pemanen->user_id);
    
    $pemanen->delete();
    $user->delete();

    Alert::success('Berhasil', 'Data Pemanen berhasil dihapus');
    return redirect()->route('datapemanen.index');
  }
}