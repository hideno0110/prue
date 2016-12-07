<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvStock;
use App\Merchant;
use App\Inventory;
use DB;
class AdminStockController extends Controller
{   
 
     public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $merchant_id = Merchant::merchantUserCheck();
      $stocks = InvStock::where('merchant_id', $merchant_id)->get();

      $inventory = Inventory::where('merchant_id', $merchant_id)->get();
      foreach ($inventory as $inv) {
        print  $inv->inv_stocks->stock;
      } 

        return view('admin.stock.index', compact('stocks'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
