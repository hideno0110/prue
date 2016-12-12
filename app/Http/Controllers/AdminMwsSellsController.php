<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Inventory;
use App\MwsSell;

class AdminMwsSellsController extends Controller
{
    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this_month = date("Y-m");

        $mws_sell = MwsSell::getMws();
        // コメントアウト11/19
        
//        $mws_sells = MwsSell::all();

        return view('admin.mws.sell.index', compact('mws_sells'));
    }
}
