<?php

namespace App\Http\Controllers\mandor;

use App\Models\GrafikKepatuhan;
use App\Models\Pemanen;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class GrafikKepatuhanController extends Controller
{
  public function index()
  {
    $filterTanggal = request('filter_tanggal');
    
    $query = GrafikKepatuhan::with('pemanen')->where('mandor_id', auth()->user()->id);
    
    // Filter berdasarkan tanggal
    if ($filterTanggal) {
      $query->whereDate('created_at', $filterTanggal);
    }
    
    
    
    $grafikkepatuhan = $query->orderBy('created_at', 'desc')->get();
    
    // Ambil data pemanen untuk dropdown filter
    $pemanenList = Pemanen::where('mandor_id', auth()->user()->id)->get();
    
    return view('pagemandor.grafik_kepatuhan.index', compact('grafikkepatuhan', 'filterTanggal'));
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
      'stampel_panen' => 'required',
    ]);

    // Buat pemanen baru
    GrafikKepatuhan::create([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keluar_buah' => $request->keluar_buah,
      'alas_karung_brondol' => $request->alas_karung_brondol,
      'panen_blok_17' => $request->panen_blok_17,
      'stampel_panen' => $request->stampel_panen,
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
      'stampel_panen' => 'required',
    ]);

    $grafikkepatuhan = GrafikKepatuhan::findOrFail($id);

    // Update data grafik kepatuhan
    $grafikkepatuhan->update([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keluar_buah' => $request->keluar_buah,
      'alas_karung_brondol' => $request->alas_karung_brondol,
      'panen_blok_17' => $request->panen_blok_17,
      'stampel_panen' => $request->stampel_panen,
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