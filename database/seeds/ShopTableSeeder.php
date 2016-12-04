<?php

use Illuminate\Database\Seeder;
use App\Shop;
use Faker\Factory as Faker;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        for($i=1; $i<50; $i++) {       
          $shop = new Shop;
          $shop->shop_list_id = rand(1,10);
          $shop->shop_branch_name = "abc".$i."支店";
          $shop->postal_code = $faker->postcode;
          $shop->prefecture = $faker->prefecture;
          $shop->city = $faker->city;
          $shop->address = "aaaaaaa";
          $shop->address2 = "bbbbbb";
          $shop->is_active = 1;
          $shop->save();       
        }
    }
}
