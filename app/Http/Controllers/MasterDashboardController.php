<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDashboardController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }

    public function index()
    {
        return view('master.index');
    }
}
