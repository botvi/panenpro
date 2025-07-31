<?php

namespace App\Http\Controllers\krani;

use App\Http\Controllers\Controller;

class DashboardKeraniController extends Controller
{
    public function index()
    {
        return view('pagekrani.dashboard.index');
    }
}