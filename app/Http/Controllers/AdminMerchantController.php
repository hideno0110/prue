<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
class AdminMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth:admin');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $merchant_id = Merchant::merchantUserCheck();

      if($merchant_id == $id) {
      
        $merchant = Merchant::findOrFail($id);
        return view('admin.merchant.edit', compact('merchant'));
      } else {
      
        return view('admin.errors.404'); 
      }
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
      try {
        $merchant = Merchant::findOrFail($id); 
        $input = $request->all();

        $merchant->update( $input);

        return redirect()->back()->with('flash_message', trans('adminlte_lang::message.updated_msg'));

      } catch (Exception $e) {  
        return redirect::back();     
      }

    }

}
