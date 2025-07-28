<?php

namespace App\Http\Controllers\asisten;

use App\Models\DataPanen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPanenController extends Controller
{
    public function index()
    {
        $datapanen = DataPanen::with(['pemanen', 'mandor'])->get();

        return view('pageasisten.data_panen.index', compact('datapanen'));
    }
}
