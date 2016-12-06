<?php

namespace App\Http\Controllers;

use DB;
use App\Inventory;
use Log;
use Illuminate\Http\Request;
use Peron\AmazonMws\AmazonOrderList;
use Peron\AmazonMws\AmazonInventoryList;
use Peron\AmazonMws\AmazonProductList;
use App\Http\Requests;
use App\Shop;
use App\ShopList;
use Auth;
use App\Merchant;
use App\RssNews;

class AdminDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    } 

    public function index(Inventory $inventory, Shop $shop, ShopList $shop_list, RssNews $rss_news) {

        //ユーザー情報を取得
        $admin_id = Auth::guard('admin')->user()->id;

        //merchant_idを取得
        $merchant_id = Merchant::merchantUserCheck();

        $this_year_month = date("Y-m"); 
        $this_year = date("Y年");
        $this_month = date("m月");
        //仕入れ総数
        $inv_count = number_format($inventory->inv_count($merchant_id));
        //店舗数(支店含む)
        $shops = $shop->shop_count($merchant_id);
        //店舗数
        $shop_lists = $shop_list->shop_list_count($merchant_id);
        //今月の仕入れ数 
        $inv_month_num = $inventory->inv_month_num($this_year_month,$merchant_id);
        //今月の仕入れ金額
        $inv_month_money = number_format($inventory->inv_month_money($this_year_month,$merchant_id));
        //仕入れ予想利益
        $inv_expect_profit = $inventory->inv_expect_profit($this_year_month, $merchant_id);
        //月別の仕入れ金額
        $monthly_purchase =  $inventory->monthly_purchase_price($merchant_id);
        //月別の仕入れ回数
        $fba_data =  $inventory->monthly_purchase_times();

        $rss_news = $rss_news->get_rss_lists($admin_id, 5);

        $compacted = compact(
          'this_year',
          'this_month',
          'inv_count',
          'shops',
          'shop_lists',
          'inv_month_num',
          'inv_month_money',
          'inv_expect_profit',
          'monthly_purchase',
          'fba_data',
          'rss_news'
        );

        return view('admin.index', $compacted);
    }
}
