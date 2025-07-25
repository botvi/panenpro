<?php

namespace App\Http\Controllers\pemanen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardPemanenController extends Controller
{
 public function index(){
    return view('pagepemanen.dashboard.index');
 }
}
