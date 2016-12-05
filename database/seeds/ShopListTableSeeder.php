<?php

use Illuminate\Database\Seeder;
use App\ShopList;
use Faker\Factory as Faker;


class ShopListTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');
        
        for($i=1; $i<20; $i++) {
         $shop_list = new ShopList;
         $shop_list->shop_name = $i.'商店';
         $shop_list->merchant_id = rand(1,4);
         $shop_list->is_active = 1;
         $shop_list->save();       
        }
//        $lists = array('shop_name' => "amazon", 'is_active' => 1);
     //   $lists = array('shop_name' => "yahoo", 'is_active' => 1);
        //   ShopList::create($list);
        // }  

//
    }
}
