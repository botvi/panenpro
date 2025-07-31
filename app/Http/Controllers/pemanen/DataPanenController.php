<?php

namespace App\Http\Controllers\pemanen;

use App\Models\DataPanen;
use App\Models\Pemanen;
use App\Models\DataBlok;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class DataPanenController extends Controller
{
  public function index()
  {
    $datapanen = DataPanen::with('pemanen', 'blok')->where('pemanen_id', auth()->user()->id)->get();
    return view('pagepemanen.data_panen.index', compact('datapanen'));
  }

  public function create()
  {
    $blok = DataBlok::all();
    return view('pagepemanen.data_panen.create', compact('blok'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'blok_id' => 'required',
      'no_tph' => 'required',
      'ripe' => 'required',
      'over_ripe' => 'required',
      'under_ripe' => 'required',
      'eb' => 'required',
      'brondolan' => 'required',
      'jumlah_buah_per_blok' => 'required',
    ]);

    // Buat data panen baru
    DataPanen::create([
      'pemanen_id' => auth()->user()->id,
      'blok_id' => $request->blok_id,
      'no_tph' => $request->no_tph,
      'ripe' => $request->ripe,
      'over_ripe' => $request->over_ripe,
      'under_ripe' => $request->under_ripe,
      'eb' => $request->eb,
      'brondolan' => $request->brondolan,
      'jumlah_buah_per_blok' => $request->jumlah_buah_per_blok,
    ]);

    Alert::success('Berhasil', 'Data Panen berhasil ditambahkan');
    return redirect()->route('datapanen.index');
  }

 
  public function edit($id)
  {
    $datapanen = DataPanen::with('pemanen', 'blok')->findOrFail($id);
    $blok = DataBlok::all();
    return view('pagepemanen.data_panen.edit', compact('datapanen', 'blok'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'blok_id' => 'required',
      'no_tph' => 'required',
      'ripe' => 'required',
      'over_ripe' => 'required',
      'under_ripe' => 'required',
      'eb' => 'required',
      'brondolan' => 'required',
      'jumlah_buah_per_blok' => 'required',
    ]);

    // Update data panen
    $datapanen = DataPanen::findOrFail($id);
    $datapanen->update([
      'pemanen_id' => auth()->user()->id,
      'blok_id' => $request->blok_id,
      'no_tph' => $request->no_tph,
      'ripe' => $request->ripe,
      'over_ripe' => $request->over_ripe,
      'under_ripe' => $request->under_ripe,
      'eb' => $request->eb,
      'brondolan' => $request->brondolan,
      'jumlah_buah_per_blok' => $request->jumlah_buah_per_blok,
    ]);

    Alert::success('Berhasil', 'Data Panen berhasil diperbarui');
    return redirect()->route('datapanen.index');
  }

  public function destroy($id)
  {
    $datapanen = DataPanen::findOrFail($id);
    $datapanen->delete();

    Alert::success('Berhasil', 'Data Panen berhasil dihapus');
    return redirect()->route('datapanen.index');
  }
}