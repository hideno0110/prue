<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 10; $i++) {
          
          User::create([
            'name' => "u".$i, 
            'email' => "u".$i."@u.com",
            'is_active' => 1,
            'password' => Hash::make('user'.$i)
          ]);

        }
    }
}
