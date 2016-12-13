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
    public function __construct()
    {
        //masterユーザーのみを通す
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
            'count_inv'
        );
    
        return view('master.admin-inventory.index',$compacted);
    }
}
