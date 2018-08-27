<?php

namespace App\Http\Controllers;

use App\FbaInventory;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class AdminFbaInventoriesController extends Controller
{

    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this_month = date("Y-m");

        $fba_invs = FbaInventory::fba_inventories();

        return view('admin.mws.fba_inv.index', compact('fba_invs'));
    }
}
