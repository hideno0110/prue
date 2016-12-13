<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTermsController extends Controller
{
    public function index()
    {
        return view('admin.terms.index');
    }

}
