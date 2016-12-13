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
    public function index()
    {
        //検索条件を取得
        $name = Input::get('name');
        $category = Input::get('category');
        $query = Inventory::query()->leftJoin('item_masters','inventories.item_master_id', '=', 'item_masters.id');
        
        //カテゴリーがある場合
        if(!empty($category)){
            $query->where('item_masters.category','like','%'.$category.'%');
        }

        //商品名の検索がある場合
        if(!empty($name)){
            $query->where('item_masters.name','like','%'.$name.'%');
        }

        $items = $query->orderBy('item_masters.id','desc')->paginate(20);
        return view('shop.index',['items'=>$items]);
    }

    public function show($id)
    {
        $item = Inventory::findOrFail($id);
        return view('shop.show',compact('item'));
    }
}
