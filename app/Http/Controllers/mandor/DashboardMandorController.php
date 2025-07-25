<?php

namespace App\Http\Controllers\mandor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardMandorController extends Controller
{
 public function index(){
    return view('pagemandor.dashboard.index');
 }
}
