<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
use DB;
use App\Merchant;
class AutoCompleteController extends Controller
{

    public function index() 
    {
        return view('admin.autocomplete.index');
    }
    
    public function autoComplete(Request $request)
    {
        //店舗IDを取得
        $merchant_id = Merchant::merchantUserCheck();
        
        $query = $request->get('term','');
        
        $products = DB::table('shops')
            ->where('shop_branch_name', 'LIKE', '%'.$query.'%')
            ->orWhere('shop_name', 'LIKE', '%'.$query.'%')
            ->where('shop_lists.merchant_id', $merchant_id)
            ->leftJoin('shop_lists', 'shops.shop_list_id', '=', 'shop_lists.id')
            ->get();

        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->shop_name.' '.$product->shop_branch_name,'id'=>$product->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=> trans('adminlte_lang::message.no_result') ,'id'=>''];
    }

    public function search_inventories(Request $request)
    {
        //店舗IDを取得
        $merchant_id = Merchant::merchantUserCheck();
        
        $query = $request->get('term','');

        $products = DB::table('inventories')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->where('merchant_id', $merchant_id)
            ->get();

        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->name,'id'=>$product->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=> trans('adminlte_lang::message.no_result'),'id'=>''];
    }
}
