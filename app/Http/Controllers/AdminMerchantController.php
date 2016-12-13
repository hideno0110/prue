<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
class AdminMerchantController extends Controller
{
    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }
    
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
