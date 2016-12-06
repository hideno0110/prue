<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvStock;
use App\Merchant;

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
            
      $stocks = InvStock::all();
      dd($stocks);
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
