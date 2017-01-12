<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Inventory;
use App\MwsSell;

class AdminMwsSellsController extends Controller
{
    public function index()
    {
        $this_month = date("Y-m");
          
        // mwsの販売リスト
        $mws_sells =  MwsSell::mws_sells_list();

        // mwsの返品リスト
        $mws_refunds = MwsSell::mws_refunds_list();

        // mwsの手数料リスト
        $mws_fees = MwsSell::mws_fees();

        // mwsの統計情報
        $mws_sums =  MwsSell::mws_sums();

        return view('admin.mws.sell.index', compact('mws_sells','mws_refunds','mws_fees','mws_sums'));

    }
}
