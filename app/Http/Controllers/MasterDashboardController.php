<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventory;
use App\Merchant;
class MasterDashboardController extends Controller
{
    public function __construct()
    {
        //masterユーザーのみを通す
        $this->middleware('auth:master');
    }
    public function index()
    {
        //登録事業者数
        $count_merchant = Merchant::merchantNumber();
        //今日の登録事業者数

        //仕入数 
        $count_inv = Inventory::where('is_active', 1)->count();

        $compacted = compact(
            'count_merchant',
            'count_inv'
        );
                          

        return view('master.index', $compacted);
    }
}
