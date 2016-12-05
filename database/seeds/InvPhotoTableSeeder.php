<?php

use Illuminate\Database\Seeder;
use App\InvPhoto;

class InvPhotoTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=1; $i < 5; $i++) {
          InvPhoto::create([
            'file' => 'inv_'.$i.'.jpg',
            'type' => 1,
            'inventory_id' => $i,
            'number' => 1
          ]);
        }      


        for ($i=99; $i > 97; $i--) {
          for($j=1; $j < 3; $j++ ) {
            InvPhoto::create([
              'file' => 'inv_'.$i.'_'.$j.'.jpg',
              'type' => 1,
              'inventory_id' => $i,
              'number' => $j
            ]);
          }
        }
    }
}
