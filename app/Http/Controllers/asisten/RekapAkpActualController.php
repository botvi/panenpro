<?php

namespace App\Http\Controllers\asisten;

use App\Http\Controllers\Controller;
use App\Models\DataRekapPengiriman;
use Illuminate\Http\Request;

class RekapAkpActualController extends Controller
{
    public function index()
    {
        $dataRekapPengiriman = DataRekapPengiriman::with('blok', 'user')->get();
        return view('pageasisten.data_rekap_pengiriman.index', compact('dataRekapPengiriman'));
    }
}