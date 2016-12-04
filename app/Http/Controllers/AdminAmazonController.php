<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peron\AmazonMws\AmazonOrderList;
use DB;
use App\AmazonOrderItem;
use App\AmazonOrder;


class AdminAmazonController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }

  public function index() {
  
  
  } 



  public function getAmazonOrders() {
          
            try {
              //トランザクション開始
              DB::beginTransaction();

              //amazon apiを利用して直近のオーダーを取得 
              $amz = new AmazonOrderList("myStore"); //store name matches the array key in the config file
              $amz->setLimits('Modified', "-24 hours");
              $amz->setFulfillmentChannelFilter("AFN"); //no Amazon-fulfilled orders
              $amz->setOrderStatusFilter(
                  array("Shipped", "Unshipped", "PartiallyShipped", "Canceled", "Unfulfillable")
                  ); //no shipped or pending
              $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
              $amz->fetchOrders();
              $amz_orders = $amz->getList();


              //取得したオーダー情報をもとに未登録のオーダーをDBへ追加登録 
              foreach($amz_orders as $amz_order) {
                  
               // $count = AmazonOrder::where('amazonOrderId', $amz_order->getamazonOrderId())->count();
              $order = AmazonOrder::firstOrCreate(['amz_order_id' => $amz_order->getamazonOrderId()]);
              

              if($order->wasRecentlyCreated){
                   
                  // $order = new AmazonOrder();
                  $order->amz_order_id = $amz_order->getAmazonOrderId();
                  $order->purchase_date = $amz_order->getPurchaseDate();
                  $order->status = $amz_order->getOrderStatus();
  
                  $order->save();

                  //オーダーに紐づくアイテム情報を登録
                   $items = $amz_order->fetchItems();
                   foreach ($items as $item) {
                     $order_item = new AmazonOrderItem();
                      $order_item->amazon_order_table_id = $order->id;
                      $order_item->sku = $item['SellerSKU'];
                      $order_item->item_name = $item['Title'];
                      $order_item->amount = $item['QuantityOrdered'];
                      $order_item->price = $item['ItemPrice']['Amount'] / $item['QuantityOrdered'];// Because ItemPrice is total for the whole line
    
                      $order_item->save();
                  }

                } else {
                    //既にオーダーが登録されている場合は何もしない
                }                 
              }
              //コミット
              DB::commit();
            } catch (Exception $e) {
              DB::rollBack();
              return Redirect::back();
            }

            return 'i did';
    }
    
}
