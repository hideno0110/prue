<?php

use Illuminate\Database\Seeder;
use App\Photo;

class PhotoTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

        // photoテーブルは admin , merchant 側で作成        
        // for ($i=1; $i < 5; $i++) {
        //   Photo::create([
        //     'file' => 'admin'.$i.'-128x128.jpg',
        //   ]);
        // }

    }
}
