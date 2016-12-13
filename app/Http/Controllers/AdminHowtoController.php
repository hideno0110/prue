<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHowtoController extends Controller
{
    public function index()
    {
      return view('admin.howto.index');
    }
}
