<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Admin;
use App\Shop;
use App\ShopList;
use App\Payment;
use App\Condition;
use App\SalePlace;
use App\Photo;
use App\InvPhoto;
use App\InvStock;
use Auth;
use DB;
class MasterAdminInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
      {
      $this->middleware('auth:master');
      }       
     public function index()
      {
        $query = Inventory::query();
    
        //結果を取得
        $inventories = $query->sortable()->orderBy('inventories.id','desc')->paginate(100);
        $count_inv = $inventories->count();
    
        $compacted = compact(
          'inventories',
          // 'shops',
          // 'shop_branch', 
          // 'payment', 
          // 'condition',
          // 'asin',
          // 'sku',
          // 'name',
          // 'shopname',
          // 'condition_ids',
          // 'sale_place',
          // 'buy_date',
          // 'query',
          // 'memo',
          // 'description',
           'count_inv'
          // 'sale_place_ids',
          // 'free'
        );
    
        return view('master.admin-inventory.index',$compacted);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
