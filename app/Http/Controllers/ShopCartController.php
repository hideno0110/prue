<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Cart;
use App\InvStock;
use Illuminate\Support\Facades\Redirect;

class ShopCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) 
    {
        $item = Inventory::findOrFail($request->id); 
        return view('shop.cart.index', compact('item'));
    }

  
    public function store(Request $request)
    {
        return view('shop.cart.complete')->with('flash_message', 'ありがとうございました');
    }
}
