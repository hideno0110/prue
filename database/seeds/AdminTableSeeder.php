<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Photo;
use Faker\Factory as Faker;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP'); 
        
        for ($i=1; $i < 20; $i++) {
          if($i <5) {         
            //id=4までは画像あり
            $photo = Photo::create([
              'file' => 'admin'.$i.'-128x128.jpg',
            ]);
            
            Admin::create([
            'name' => $faker->name.$i, 
            'email' => "a".$i."@a.com",
            'merchant_id' => 1,
            'role_id' => 1,
            'is_active' => 1,
            'photo_id' => $photo->id,
            'password' => Hash::make('admin'.$i)
          ]);
        } else {
             Admin::create([
            'name' => $faker->name.$i, 
            'email' => "a".$i."@a.com",
            'merchant_id' => rand(2,4), 
            'role_id' => 1,
            'is_active' => 1,
            'photo_id' => 0,
            'password' => Hash::make('admin'.$i)
          ]);
        }
      }
    }    
}
