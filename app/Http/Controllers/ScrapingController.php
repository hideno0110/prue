<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopMap;
use Goutte;

class ScrapingController extends Controller
{
    public function __construct()
    {
        //adminユーザーのみを通す
        $this->middleware('auth:admin');
    }   
      
    public function index()
    {
        $shop_lists = ShopMap::all();
        return view('tools.shop_maps.index',compact('shop_lists')); 
    }
    
    public function scraping(Request $reauest)
    {
        //DB削除 
        ShopMap::truncate();

        for($j=10; $j < 14; $j++) {
         
           $crawler = Goutte::request('GET', 'http://www.treasure-f.com/shop/'.$j.'/area.html');
             
           $crawler->filter('.inner2 .txtbox')->each(function($node) {  
               $list = new ShopMap();
               $list->shop = 'トレジャーファクトリー'; 
               $list->shop_category = trim($node->filter('.cap')->text());
               $list->shop_branch = trim($node->filter('h4')->text());
               $list->url = trim($node->filter('h4 a')->attr('href'));
               $list_i[] =  $node->filter('.address li')->each(function($node2) use ($list) {
                  return  trim($node2->filter('li')->text());
               });
               $list->postal_code = $list_i[0][0];
               $list->address1 = $list_i[0][1];
               $list->tel = $list_i[0][2];
               $list->time = trim($node->filter('.service_time')->text());
           
               $list->save();
           });
         }
         return redirect()->back();
    }
}
