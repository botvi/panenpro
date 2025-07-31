<?php

namespace App\Http\Controllers\mandor;

use App\Models\AktualAKP;
use App\Models\DataBlok;
use App\Models\PlanAKP;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AKPController extends Controller
{

  public function indexAKP()
  {
    $planakp = PlanAKP::with('mandor', 'blok')->where('mandor_id', auth()->user()->id)->get();
    $aktualakp = AktualAKP::with('mandor', 'blok')->where('mandor_id', auth()->user()->id)->get();
    return view('pagemandor.akp.index', compact('planakp', 'aktualakp'));
  }

  // PLAN AKP
  public function createPlanAKP()
  {
    $blok = DataBlok::all();
    return view('pagemandor.akp.plan.create', compact('blok'));
  }

  public function storePlanAKP(Request $request)
  {
    $request->validate([
      'blok_id' => 'required',
      'satuan_per_hektar' => 'required',
      'jumlah_janjang' => 'required',
      'total' => 'required',
    ]);



    // Buat plan akp
    PlanAKP::create([
      'mandor_id' => auth()->user()->id,
      'blok_id' => $request->blok_id,
      'satuan_per_hektar' => $request->satuan_per_hektar,
      'jumlah_janjang' => $request->jumlah_janjang,
      'total' => $request->total,
    ]);

    Alert::success('Berhasil', 'Data Plan AKP berhasil ditambahkan');
    return redirect()->route('akp.index');
  }


  public function editPlanAKP($id)
  {
    $planakp = PlanAKP::with('mandor', 'blok')->findOrFail($id);
    $blok = DataBlok::all();
    return view('pagemandor.akp.plan.edit', compact('planakp', 'blok'));
  }

  public function updatePlanAKP(Request $request, $id)
  {
    $request->validate([
      'blok_id' => 'required',
      'satuan_per_hektar' => 'required',
      'jumlah_janjang' => 'required',
      'total' => 'required',
    ]);

    $planakp = PlanAKP::findOrFail($id);



    // Update data plan akp
    $planakp->update([
      'blok_id' => $request->blok_id,
      'satuan_per_hektar' => $request->satuan_per_hektar,
      'jumlah_janjang' => $request->jumlah_janjang,
      'total' => $request->total,
      'mandor_id' => auth()->user()->id,
    ]);

    Alert::success('Berhasil', 'Data Plan AKP berhasil diperbarui');
    return redirect()->route('akp.index');
  }

  public function destroyPlanAKP($id)
  {
    $planakp = PlanAKP::findOrFail($id);
    $planakp->delete();

    Alert::success('Berhasil', 'Data Plan AKP berhasil dihapus');
    return redirect()->route('akp.index');
  }

  // AKTUAL AKP

  public function createAktualAKP()
  {
    $blok = DataBlok::all();
    return view('pagemandor.akp.aktual.create', compact('blok'));
  }

  public function storeAktualAKP(Request $request)
  {
    $request->validate([
      'blok_id' => 'required',
      'satuan_per_hektar' => 'required',
      'jumlah_janjang' => 'required',
      'total' => 'required',
    ]);



    // Buat aktual akp
    AktualAKP::create([
      'mandor_id' => auth()->user()->id,
      'blok_id' => $request->blok_id,
      'satuan_per_hektar' => $request->satuan_per_hektar,
      'jumlah_janjang' => $request->jumlah_janjang,
      'total' => $request->total,
    ]);

    Alert::success('Berhasil', 'Data Aktual AKP berhasil ditambahkan');
    return redirect()->route('akp.index');
  }


  public function editAktualAKP($id)
  {
    $aktualakp = AktualAKP::with('mandor', 'blok')->findOrFail($id);
    $blok = DataBlok::all();
    return view('pagemandor.akp.aktual.edit', compact('aktualakp', 'blok'));
  }

  public function updateAktualAKP(Request $request, $id)
  {
    $request->validate([
      'blok_id' => 'required',
      'satuan_per_hektar' => 'required',
      'jumlah_janjang' => 'required',
      'total' => 'required',
    ]);

    $aktualakp = AktualAKP::findOrFail($id);



    // Update data aktual akp
    $aktualakp->update([
      'blok_id' => $request->blok_id,
      'satuan_per_hektar' => $request->satuan_per_hektar,
      'jumlah_janjang' => $request->jumlah_janjang,
      'total' => $request->total,
      'mandor_id' => auth()->user()->id,
    ]);

    Alert::success('Berhasil', 'Data Aktual AKP berhasil diperbarui');
    return redirect()->route('akp.index');
  }

  public function destroyAktualAKP($id)
  {
    $aktualakp = AktualAKP::findOrFail($id);
    $aktualakp->delete();

    Alert::success('Berhasil', 'Data Aktual AKP berhasil dihapus');
    return redirect()->route('akp.index');
  }
}
