<?php

use Illuminate\Database\Seeder;
use App\ShopList;
use App\Shop;
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

        $shop_list_names = array('中原商店', 'サードストリート', 'トレジャーグループ', 'Soft OFF', '2nd チャンス');
        $shop_branch_names = array('山手','青葉','横手','東','北','国道沿い', '花道','東海岸沿い','横丁','県道沿い');

        for($i=0; $i<5; $i++) {
         $shop_list = new ShopList;
         $shop_list->shop_name = $shop_list_names[$i];
         $shop_list->merchant_id = rand(1,2);
         $shop_list->is_active = 1;
         $shop_list->save();       

           for($j=0; $j<10; $j++) {       
             $shop = new Shop;
             $shop->shop_list_id = $shop_list->id;
             $shop->shop_branch_name = $shop_branch_names[$j]."支店";
             $shop->postal_code = $faker->postcode;
             $shop->prefecture = $faker->prefecture;
             $shop->city = $faker->city;
             $shop->address = "1-2-3";
             $shop->address2 = "Prueビルディング1".$j;
             $shop->is_active = 1;
             $shop->save();       
           }
        }
    }
}      
