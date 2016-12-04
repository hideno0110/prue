<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
use DB;
class AutoCompleteController extends Controller {

    public function index(){
        return view('admin.autocomplete.index');
    }
    public function autoComplete(Request $request) {

        $query = $request->get('term','');

        $products = DB::table('shops')
            ->where('shop_branch_name', 'LIKE', '%'.$query.'%')
            ->orWhere('shop_name', 'LIKE', '%'.$query.'%')
            ->leftJoin('shop_lists', 'shops.shop_list_id', '=', 'shop_lists.id')
            ->get();

        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->shop_name.' '.$product->shop_branch_name,'id'=>$product->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

    public function search_inventories(Request $request) {

        $query = $request->get('term','');

        $products = DB::table('inventories')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->get();

        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->name,'id'=>$product->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }


}
