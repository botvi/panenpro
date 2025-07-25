<?php

namespace App\Http\Controllers\asisten;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardAsistenController extends Controller
{
 public function index(){
    return view('pageasisten.dashboard.index');
 }
}
