<?php

namespace App\Task;

use Illuminate\Database\Eloquent\Model;
use App\ShopMap;
use Log;
use DB;
use Goutte;
class ShopMapCron extends Model
{

  public static function shop_map() {
    //スクレイピングで各店舗の住所を取得する 
    Log::debug('start scraping task');
    //DB削除 
    ShopMap::truncate();

    // shop1
    for($j=12; $j < 14; $j++) {
    
      $crawler = Goutte::request('GET', 'http://www.treasure-f.com/shop/'.$j.'/area.html');
      $crawler->filter('.inner2 .txtbox')->each(function($node) 
      {  
        $list = new ShopMap();
          $list->shop_id = 1;
          $list->shop = 'トレファク'; 
          $list->shop_category = trim($node->filter('.cap')->text());
          $list->shop_branch = trim($node->filter('h4')->text());
          $list->url = trim($node->filter('h4 a')->attr('href'));
          $list_i[] =  $node->filter('.address li')->each(function($node2) use ($list){
             return  trim($node2->filter('li')->text());
          });
          $list->postal_code = $list_i[0][0];
          $list->address1 = $list_i[0][1];
          $list->tel = $list_i[0][2];
          $list->time = trim($node->filter('.service_time')->text());
      
          $list->save();
      });
    }
    
    // shop2 
    // for($j=13; $j < 15; $j++) {
    //
    //   $crawler = Goutte::request('GET', 'http://www.2ndstreet.jp/shop/search?prefectural='.$j);
    //   $crawler->filter('.shop_result.shop-srch-rslt-pc li')->each(function($node) 
    //   { 
    //       $list = new ShopMap();
    //       $list->shop_id = 2;
    //       $list->shop = '2nd';
    //       $list_i[] =  $node->filter('.shop_search_title li')->each(function($node2) use ($list){
    //         return  trim($node2->text());
    //       });
    //       $list->shop_category = $list_i[0][0];
    //       $list->shop_branch = $list_i[0][1];
    //       $list_i2[] =  $node->filter('.shop_detail_dl dd')->each(function($node3) use ($list){
    //          return  trim($node3->text());
    //       });
    //       $list->url = 'http://www.2ndstreet.jp'.trim($node->filter('.shop_detail_dl a')->attr('href'));
    //       $list->postal_code = str_replace("〒", "",mb_strstr($list_i2[0][0],"\n", true));
    //       $list->address1 = trim( mb_strstr($list_i2[0][0],"\n", false));
    //       $list->tel = $list_i2[0][1];
    //       $list->time = $list_i2[0][2];
    //   
    //       Log::debug($list->shop_id.":".$list->shop_category);
    //       $list->save();
    //   });
    // }



    // shop1
    // for($j=12; $j < 14; $j++) {
    
      // $crawler = Goutte::request('GET', 'http://www.hardoff.co.jp/shop/kanto/tokyo/');
      // $crawler->filter('table')->each(function($node) 
      // {  
      //   $list = new ShopMap();
      //     $list->shop_id = 2;
      //     $list->shop = 'Hard'; 
      //     $list->shop_category = trim($node->filter('storeName')->text());
      //     $list->shop_branch = trim($node->filter('storeName')->text());
      //     $list->url = trim($node->filter('storeName')->attr('href'));
      //     // $list_i[] =  $node->filter('.address li')->each(function($node2) use ($list){
      //     //    return  trim($node2->filter('li')->text());
      //     // });
      //     // $list->postal_code = $list_i[0][0];
      //     // $list->address1 = $list_i[0][1];
      //     // $list->tel = $list_i[0][2];
      //     // $list->time = trim($node->filter('.service_time')->text());
      //     var_dump($list);
      //
      //     $list->save();
      // });
    // }

  }



  public static function shop_map_latlnt() {
    //google map で緯度経度を取得
     Log::debug('start googlemap lat task');
     $shops = Shopmap::all();           
     $max = 100; 

     foreach($shops as $shop) {
       // 取得回数を制限する
       if( $shop->id >= $max ) {
         break;
       }
       // 取得済みの場合は処理をスキップ
       if( $shop->lat != 0 ) {
         continue;
       }
       $ret = self::getLatLnt($shop);
       $shop->lat = $ret["lat"];
       $shop->lng = $ret["lng"];
       $shop->save();
       sleep(3);           
     }
  }

    public static function getLatLnt($shop)
    { 
      try{
         $strAddress = $shop->address1;
         if (!is_null($strAddress) && '' != $strAddress) {
            $strAddress = trim($strAddress);
            $strAddress = urlencode($strAddress);
            $url = "http://maps.google.com/maps/api/geocode/json?";
            $url .= "address={$strAddress}&sensor=false";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($response, true);
            if (isset($res['results'][0]['geometry']['location'])) {
                return $res['results'][0]['geometry']['location'];
            } else {
                throw new Exception('Cannot get lat and lon by geocoding.');
            }
         }
      } catch (Exception $e) {
          return Redirect::back();
      }
    }     
}
