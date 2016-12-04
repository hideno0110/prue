<?php

use Illuminate\Database\Seeder;
use App\Inventory;
use Faker\Factory as Faker;


class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create('ja_JP'); 
        for ($i=1; $i < 100; $i++) {
          Inventory::create([
            'merchant_id' => rand(1,4),
            'photo_id' => 0,
            'asin' => "asin".$i,
            'jan_code' => "jan12345",
            'sku' => "sku".$i,
            'name' => "item".$i,
            'shop_id' => rand(1,10),
            'buy_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = date_default_timezone_get()),
            'number' => rand(0,10),
            'buy_price' => rand(1000,5000),
            'sell_price' => rand(1000,20000),
            'payment_id' => rand(1,2),
            'condition_id' => rand(1,3),
            'sale_place_id' => rand(1,3),
            'description' => "good description",
            'description_1' => "good description1",
            'description_2' => "good description2",
            'memo' => "hello memo",
            'ebay_id' => "1",
            'ebay_memo' => "ebaymemo",
            'free' => 1,
            'free_memo' => "free_memo",
            'sku2' => "sku2",
            'shipping_type' => 1,
            'update_admin_id' => 0,
            'is_active' =>1
        ]);
      }
    }
}
