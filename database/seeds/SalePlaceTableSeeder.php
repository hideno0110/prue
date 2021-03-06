<?php

use Illuminate\Database\Seeder;
use App\SalePlace;

class SalePlaceTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

         $sale_places = [
            [ 'name' => 'Prue' ],
            [ 'name' => 'amazonJP-FBA' ],
            [ 'name' => 'amazonJP-MBA' ],
            [ 'name' => 'yahooショッピング' ],
            [ 'name' => 'JP_FBA' ],
            [ 'name' => 'メルカリ' ],
            [ 'name' => 'ヤフオク' ],
            [ 'name' => 'ebay' ],
            [ 'name' => 'BASE' ]
        ];
        foreach( $sale_places as $sale_place ) {
          $place = new SalePlace();
          $place->name = $sale_place['name'];
          $place->save();
        }
    }
}
