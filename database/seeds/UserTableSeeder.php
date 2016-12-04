<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 10; $i++) {
          
          User::create([
            'name' => "user".$i, 
            'email' => "user".$i."@u.com",
            'is_active' => 1,
            'password' => Hash::make('user'.$i)
          ]);

        }
    }
}
