<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDashboardController extends Controller
{
  public function __construct()
    {
      $this->middleware('auth:master');
    }

  public function index() {
  
  return view('master.index');
  
  }
}
