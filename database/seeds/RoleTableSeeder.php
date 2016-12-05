<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        
        $roles = [
            [ 'name' => 'administrator' ],
            [ 'name' => 'subscriber' ],
            [ 'name' => 'editor' ]
        ];
        foreach( $roles as $role ) {
          $role_i = new Role();
          $role_i->name = $role['name'];
          $role_i->save();
        }

    }
}
