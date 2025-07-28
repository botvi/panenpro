<?php

namespace App\Http\Controllers\mandor;

use App\Models\AbsensiBerkala;
use App\Models\Pemanen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class AbsensiBerkalaController extends Controller
{
  public function index()
  {
    $absensiberkala = AbsensiBerkala::with('pemanen')->where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_berkala.index', compact('absensiberkala'));
  }

  public function create()
  {
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_berkala.create', compact('pemanen'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'blok' => 'required',
      'baris' => 'required',
      'arah_masuk' => 'required',
      'jam' => 'required',
    ]);

    // Buat pemanen baru
    AbsensiBerkala::create([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'blok' => $request->blok,
      'baris' => $request->baris,
      'arah_masuk' => $request->arah_masuk,
      'jam' => $request->jam,
      'luasan' => $request->luasan,
    ]);

    Alert::success('Berhasil', 'Data Absensi Berkala berhasil ditambahkan');
    return redirect()->route('absensiberkala.index');
  }

 
  public function edit($id)
  {
    $absensiBerkala = AbsensiBerkala::with('pemanen')->findOrFail($id);
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_berkala.edit', compact('absensiBerkala', 'pemanen'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'blok' => 'required',
      'baris' => 'required',
      'arah_masuk' => 'required',
      'jam' => 'required',
    ]);

    $absensiberkala = AbsensiBerkala::findOrFail($id);

    // Update data absensi pemanen
    $absensiberkala->update([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'blok' => $request->blok,
      'baris' => $request->baris,
      'arah_masuk' => $request->arah_masuk,
      'jam' => $request->jam,
      'luasan' => $request->luasan,
    ]);

    Alert::success('Berhasil', 'Data Absensi Berkala berhasil diperbarui');
    return redirect()->route('absensiberkala.index');
  }

  public function destroy($id)
  {
    $absensiberkala = AbsensiBerkala::findOrFail($id);
    $absensiberkala->delete();

    Alert::success('Berhasil', 'Data Absensi Berkala berhasil dihapus');
    return redirect()->route('absensiberkala.index');
  }
}