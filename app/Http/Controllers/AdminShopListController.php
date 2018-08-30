<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopListsCreateRequest;
use Illuminate\Http\Request;
use DB;
use App\Shop;
use App\ShopList;
use Auth;
use App\Admin;
class AdminShopListController extends Controller {

    public function __construct() {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }

    public function index(ShopList $shop_lists) {

        $admin_id = Auth::guard('admin')->user()->id;
        $merchant_id = admin::find($admin_id)->merchant_id;

        $shop_lists = $shop_lists->where('merchant_id', $merchant_id)->get();
        
        $users = Admin::where('merchant_id', $merchant_id)->get();


        return view('admin.shop_lists.index',compact('shop_lists','shop_count'));
    }
    
    public function store(ShopListsCreateRequest $request) {
        try {
            //トランザクション開始
            DB::beginTransaction();       
            
            $shop_list = ShopList::create($request->all());

            $admin_id = Auth::guard('admin')->user()->id;
            $merchant_id = admin::find($admin_id)->merchant_id;

            $shop_list->merchant_id = $merchant_id;
            $shop_list->is_active =1;
            $shop_list->save();
            
            //コミット
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back();
        }
        return redirect('/admin/shops')->with('flash_message',trans('adminlte_lang::message.created_msg'));
    }
    
    
    public function edit($id) {
        $shop_list = ShopList::findOrFail($id);
        return view('admin.shop_lists.edit', compact('shop_list'));
    }
    
    public function update(ShopListsCreateRequest $request, $id) {
        $shop_list = ShopList::findOrFail($id);

        try {
            $shop_list->update($request->all());
        } catch (Exception $e) {
            return Redirect::back();
        }

        return redirect('/admin/shop_lists')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
    }

    public function destroy($id) {
        ShopList::findOrFail($id)->delete();
        return redirect('/admin/shop_lists')->with('flash_message',trans('adminlte_lang::message.deleted_msg'));
    }
}
