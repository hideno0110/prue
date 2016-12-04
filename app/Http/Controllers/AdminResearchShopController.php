<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopMap;
use Log;
use Goutte;
class AdminResearchShopController extends Controller
{
    public function index()
    {
      $shop_lists = ShopMap::all();

      return view('admin.research_shops.index',compact('shop_lists')); 
    }
}
