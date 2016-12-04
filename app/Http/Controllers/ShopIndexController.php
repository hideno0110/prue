<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Item_stock;
use App\Cart;
use Illuminate\Support\Facades\Input;

class ShopIndexController extends Controller
{

  public function index() {


    $name = Input::get('name');
    $items = Inventory::all();

    //dd($items->inv_photo->first()->file);
    // if(!empty($name)){
    //   $query->where('name','like','%'.$name.'%');
    // } 
    //
    // $items = $query->orderBy('id','desc')->paginate(15);


    return view('shop.index',['items'=>$items]);
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
