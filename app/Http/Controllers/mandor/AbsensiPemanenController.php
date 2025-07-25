<?php

namespace App\Http\Controllers\mandor;

use App\Models\AbsensiPemanen;
use App\Models\Pemanen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class AbsensiPemanenController extends Controller
{
  public function index()
  {
    $absensipemanen = AbsensiPemanen::with('pemanen')->where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_pemanen.index', compact('absensipemanen'));
  }

  public function create()
  {
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_pemanen.create', compact('pemanen'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'keterangan' => 'required',
    ]);

    // Buat pemanen baru
    AbsensiPemanen::create([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keterangan' => $request->keterangan,
    ]);

    Alert::success('Berhasil', 'Data Absensi Pemanen berhasil ditambahkan');
    return redirect()->route('absensipemanen.index');
  }

 
  public function edit($id)
  {
    $absensipemanen = AbsensiPemanen::with('pemanen')->findOrFail($id);
    $pemanen = Pemanen::where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.absensi_pemanen.edit', compact('absensipemanen', 'pemanen'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'pemanen_id' => 'required',
      'keterangan' => 'required',
    ]);

    $absensipemanen = AbsensiPemanen::findOrFail($id);

    // Update data absensi pemanen
    $absensipemanen->update([
      'pemanen_id' => $request->pemanen_id,
      'mandor_id' => auth()->user()->id,
      'keterangan' => $request->keterangan,
    ]);

    Alert::success('Berhasil', 'Data Absensi Pemanen berhasil diperbarui');
    return redirect()->route('absensipemanen.index');
  }

  public function destroy($id)
  {
    $absensipemanen = AbsensiPemanen::findOrFail($id);
    $absensipemanen->delete();

    Alert::success('Berhasil', 'Data Absensi Pemanen berhasil dihapus');
    return redirect()->route('absensipemanen.index');
  }
}