<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\ShopList;

class MasterAdminShopController extends Controller
{

    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }
  
    public function index()
    {
        $shops = ShopList::all();
        return view('master.admin-shop.index', compact('shops'));
    }
}
