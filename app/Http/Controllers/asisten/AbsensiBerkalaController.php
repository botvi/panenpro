<?php

namespace App\Http\Controllers\asisten;

use App\Models\AbsensiBerkala;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsensiBerkalaController extends Controller
{
    /**
     * Display Absensi Berkala data for asisten (read-only)
     */
    public function index()
    {
        $absensiberkala = AbsensiBerkala::with(['pemanen', 'mandor', 'blok'])->get();

        return view('pageasisten.absensi_berkala.index', compact('absensiberkala'));
    }
}
