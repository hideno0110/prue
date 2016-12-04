<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Cart;
use App\InvStock;
use Illuminate\Support\Facades\Redirect;

class ShopCartController extends Controller
{
  public function __construct(){
        $this->middleware('auth');
  }

  public function index() {
    $carts = Cart::with('inventory')->get();
    $total_price = 0;
    foreach($carts as $cart) {
      $total_price += $cart->inventory->sell_price * $cart->amount;
    }
    return view('shop.cart.index',['carts'=> $carts,'total_price'=>$total_price]);
  }

  public function update(Request $request, $id) {
    $cart = Cart::findOrFail($id);
    $cart->amount = $request->amount;
    $cart->save();
    return redirect('/shop/cart')->with('flash_message', '更新しました');
  }

  public function delete($id) {
    $cart = Cart::findOrFail($id);
    $cart->delete();
    return redirect('/shop/cart')->with('flash_message', '削除しました');
  }
  
  public function store(Request $request) {
    //viewへの受け渡し用
    $tmp_carts = Cart::with('inventory')->get();
    $total_price = 0;
    foreach($tmp_carts as $cart) {
      $total_price += $cart->inventory->sell_price * $cart->amount;
    }

    //カートから商品を削除する 
    $carts = Cart::with('inventory');
    $carts->delete();

    return redirect('/shop')->with('flash_message', 'ありがとうございました');;

  }
}
