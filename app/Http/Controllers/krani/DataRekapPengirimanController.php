<?php

namespace App\Http\Controllers\krani;

use App\Models\DataRekapPengiriman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\DataBlok;

class DataRekapPengirimanController extends Controller
{
    public function index()
    {
        $dataRekapPengiriman = DataRekapPengiriman::with('blok', 'user')->where('user_id', auth()->user()->id)->get();
        return view('pagekrani.data_rekap_pengiriman.index', compact('dataRekapPengiriman'));
    }
    public function create()
    {
        $blok = DataBlok::all();
        return view('pagekrani.data_rekap_pengiriman.create', compact('blok'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'blok_id' => 'required',
            'no_tph' => 'required',
            'kode_panen' => 'required',
            'ripe' => 'required',
            'over' => 'required',
            'ur' => 'required',
            'udr' => 'required',
            'total' => 'required',
            'brd' => 'required',
            'bs' => 'required',
            'bjr' => 'required',
            'sph' => 'required',
            'akp_actual' => 'required',
        ]);

        DataRekapPengiriman::create([
            'user_id' => auth()->user()->id,
            'blok_id' => $request->blok_id,
            'no_tph' => $request->no_tph,
            'kode_panen' => $request->kode_panen,
            'ripe' => $request->ripe,
            'over' => $request->over,
            'ur' => $request->ur,
            'udr' => $request->udr,
            'total' => $request->total,
            'brd' => $request->brd,
            'bs' => $request->bs,
            'bjr' => $request->bjr,
            'sph' => $request->sph,
            'akp_actual' => $request->akp_actual,
        ]);

        Alert::success('Berhasil', 'Data Rekap Pengiriman berhasil ditambahkan');
        return redirect()->route('data-rekap-pengiriman.index');
    }
    public function edit($id)
    {
        $dataRekapPengiriman = DataRekapPengiriman::with('blok')->findOrFail($id);
        $blok = DataBlok::all();
        return view('pagekrani.data_rekap_pengiriman.edit', compact('dataRekapPengiriman', 'blok'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'blok_id' => 'required',
            'no_tph' => 'required',
            'kode_panen' => 'required',
            'ripe' => 'required',
            'over' => 'required',
            'ur' => 'required',
            'udr' => 'required',
            'total' => 'required',
            'brd' => 'required',
            'bs' => 'required',
            'bjr' => 'required',
            'akp_actual' => 'required',
        ]);

        $dataRekapPengiriman = DataRekapPengiriman::findOrFail($id);
        $dataRekapPengiriman->update($request->all());

        Alert::success('Berhasil', 'Data Rekap Pengiriman berhasil diperbarui');
        return redirect()->route('data-rekap-pengiriman.index');
    }
    public function destroy($id)
    {
        $dataRekapPengiriman = DataRekapPengiriman::findOrFail($id);
        $dataRekapPengiriman->delete();

        Alert::success('Berhasil', 'Data Rekap Pengiriman berhasil dihapus');
        return redirect()->route('data-rekap-pengiriman.index');
    }

    public function getBlokSph($id)
    {
        $blok = DataBlok::findOrFail($id);
        return response()->json([
            'sph' => $blok->sph,
        ]);
    }
}
