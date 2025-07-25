<?php

namespace App\Http\Controllers\mandor;

use App\Models\GrafikKepatuhan;
use App\Models\Pemanen;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GrafikKepatuhanController extends Controller
{
  public function index()
  {
    $grafikkepatuhan = GrafikKepatuhan::with('pemanen')->where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.grafik_kepatuhan.index', compact('grafikkepatuhan'));
  }

  public function create()
  {
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.grafik_kepatuhan.create', compact('pemanen'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'keluar_buah' => 'required',
      'alas_karung_brondol' => 'required',
      'panen_blok_17' => 'required',
    ]);

    // Buat pemanen baru
    GrafikKepatuhan::create([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keluar_buah' => $request->keluar_buah,
      'alas_karung_brondol' => $request->alas_karung_brondol,
      'panen_blok_17' => $request->panen_blok_17,
    ]);

    Alert::success('Berhasil', 'Data Grafik Kepatuhan berhasil ditambahkan');
    return redirect()->route('grafikkepatuhan.index');
  }

 
  public function edit($id)
  {
    $grafikkepatuhan = GrafikKepatuhan::with('pemanen')->findOrFail($id);
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.grafik_kepatuhan.edit', compact('grafikkepatuhan', 'pemanen'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'keluar_buah' => 'required',
      'alas_karung_brondol' => 'required',
      'panen_blok_17' => 'required',
    ]);

    $grafikkepatuhan = GrafikKepatuhan::findOrFail($id);

    // Update data grafik kepatuhan
    $grafikkepatuhan->update([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keluar_buah' => $request->keluar_buah,
      'alas_karung_brondol' => $request->alas_karung_brondol,
      'panen_blok_17' => $request->panen_blok_17,
    ]);

    Alert::success('Berhasil', 'Data Grafik Kepatuhan berhasil diperbarui');
    return redirect()->route('grafikkepatuhan.index');
  }

  public function destroy($id)
  {
    $grafikkepatuhan = GrafikKepatuhan::findOrFail($id);
    $grafikkepatuhan->delete();

    Alert::success('Berhasil', 'Data Grafik Kepatuhan berhasil dihapus');
    return redirect()->route('grafikkepatuhan.index');
  }
}