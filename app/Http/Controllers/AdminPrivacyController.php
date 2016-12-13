<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPrivacyController extends Controller
{
    public function index() 
    {
        return view('admin.privacy.index');
    }
}
