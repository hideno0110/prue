<?php

use Illuminate\Database\Seeder;
use App\Master;

class MasterTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
           Master::create([
            'name' => "I am Master", 
            'email' => "master@m.com",
            'is_active' => 1,
            'password' => Hash::make('master')
          ]);

       //
    }
}
