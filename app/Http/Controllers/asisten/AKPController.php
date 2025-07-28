<?php

namespace App\Http\Controllers\asisten;

use App\Models\AktualAKP;
use App\Models\PlanAKP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AKPController extends Controller
{
    /**
     * Display AKP data for asisten (read-only)
     */
    public function indexAKP()
    {
        $planakp = PlanAKP::with(['mandor'])->get();
        $aktualakp = AktualAKP::with(['mandor'])->get();

        return view('pageasisten.akp.index', compact('planakp', 'aktualakp'));
    }
}
