<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Item_stock;
use App\Cart;
use DB;
use App\ItemMaster;
use Illuminate\Support\Facades\Input;

class ShopIndexController extends Controller
{

  public function index() {


    $name = Input::get('name');
    $query = Inventory::query();

    if(!empty($name)){
      $query->where('item_masters.name','like','%'.$name.'%')
                 ->leftJoin('item_masters', 'inventories.item_master_id', '=', 'item_masters.id')
                  ->orderBy('item_masters.id','desc');
    $items = $query->paginate(20);
    } else {

          $items = $query->orderBy('id','desc')->paginate(20);

    }    

    return view('shop.index',['items'=>$items]);
}


  public function show($id) {
    $item = Inventory::findOrFail($id);

    return view('shop.show',compact('item'));
  }



  public function item_insert(Request $request, $id) {

    //カートに追加する
    $cart = new Cart();
    $cart->inventory_id = $id;
    $cart->amount++;

    $cart->save();

    //在庫をマイナスする
    // $item = Item::findOrFail($id);

    return redirect()->back()->with('flash_message','カートに追加しました');
    
  }


}
