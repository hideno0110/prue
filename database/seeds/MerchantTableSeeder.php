<?php

use Illuminate\Database\Seeder;
use App\Merchant;
use Faker\Factory as Faker;
use App\Photo;
class MerchantTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('ja_JP');
        
        for($i=1; $i<5; $i++) {       
          
          $photo = Photo::create([
            'file' => 'merchant'.$i.'.jpg',
          ]);
          
          $merchant = new Merchant;
          $merchant->name = "Merchant".$i."";
          $merchant->tel = $i.$i.$i.$i.$i.$i.$i.$i;
          $merchant->mail = $i.'@'.$i.'.com';
          $merchant->postal_code = $faker->postcode;
          $merchant->prefecture = $faker->prefecture;
          $merchant->city = $faker->city;
          $merchant->address = "aaaaaaa";
          $merchant->address2 = "bbbbbb";
          $merchant->photo_id = $photo->id;         
          $merchant->is_active = 1;
          $merchant->save();       



        }



    }
}
