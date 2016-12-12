<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminQaController extends Controller
{
    public function index() 
    {
        return view('admin.qa.index');
    }
}
