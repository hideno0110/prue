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
            'name' => "管理者太郎", 
            'email' => "m@m.com",
            'is_active' => 1,
            'password' => Hash::make('master')
          ]);

       //
    }
}
