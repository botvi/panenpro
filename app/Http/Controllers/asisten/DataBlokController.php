<?php

namespace App\Http\Controllers\asisten;

use App\Models\DataBlok;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class DataBlokController extends Controller
{
    public function index()
    {
        $dataBlok = DataBlok::all();
        return view('pageasisten.data_blok.index', compact('dataBlok'));
    }

    public function create()
    {
        return view('pageasisten.data_blok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'blok' => 'required',
            'estate' => 'required',
            'adfeling' => 'required',
            'tt' => 'required|integer',
            'luas' => 'required|integer',
            'bjr' => 'required|integer',
            'sph' => 'required|integer',
            'jumlah_pokok' => 'required|integer',
        ]);

        DataBlok::create([
            'blok' => $request->blok,
            'estate' => $request->estate,
            'adfeling' => $request->adfeling,
            'tt' => $request->tt,
            'luas' => $request->luas,
            'bjr' => $request->bjr,
            'sph' => $request->sph,
            'jumlah_pokok' => $request->jumlah_pokok,
        ]);

        Alert::success('Berhasil', 'Data Blok berhasil ditambahkan');
        return redirect()->route('datablok.index');
    }

    public function show($id)
    {
        $blok = DataBlok::findOrFail($id);
        return view('pageasisten.data_blok.show', compact('blok'));
    }

    public function edit($id)
    {
        $blok = DataBlok::findOrFail($id);
        return view('pageasisten.data_blok.edit', compact('blok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'blok' => 'required',
            'estate' => 'required',
            'adfeling' => 'required',
            'tt' => 'required|integer',
            'luas' => 'required|integer',
            'bjr' => 'required|integer',
            'sph' => 'required|integer',
            'jumlah_pokok' => 'required|integer',
        ]);

        $blok = DataBlok::findOrFail($id);

        $blok->update([
            'blok' => $request->blok,
            'estate' => $request->estate,
            'adfeling' => $request->adfeling,
            'tt' => $request->tt,
            'luas' => $request->luas,
            'bjr' => $request->bjr,
            'sph' => $request->sph,
            'jumlah_pokok' => $request->jumlah_pokok,
        ]);

        Alert::success('Berhasil', 'Data Blok berhasil diperbarui');
        return redirect()->route('datablok.index');
    }

    public function destroy($id)
    {
        $blok = DataBlok::findOrFail($id);

        $blok->delete();

        Alert::success('Berhasil', 'Data Blok berhasil dihapus');
        return redirect()->route('datablok.index');
    }
}