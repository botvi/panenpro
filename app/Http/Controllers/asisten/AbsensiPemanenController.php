<?php

namespace App\Http\Controllers\asisten;

use App\Models\AbsensiPemanen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsensiPemanenController extends Controller
{
    /**
     * Display Absensi Pemanen data for asisten (read-only)
     */
    public function index()
    {
        $absensipemanen = AbsensiPemanen::with(['pemanen', 'mandor'])->get();

        return view('pageasisten.absensi_pemanen.index', compact('absensipemanen'));
    }
}
