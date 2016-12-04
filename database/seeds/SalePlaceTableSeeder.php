<?php

use Illuminate\Database\Seeder;
use App\SalePlace;

class SalePlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $sale_places = [
            [ 'name' => 'JP_FBA' ],
            [ 'name' => 'メルカリ' ],
            [ 'name' => 'ヤフオク' ]
        ];
        foreach( $sale_places as $sale_place ) {
          $place = new SalePlace();
          $place->name = $sale_place['name'];
          $place->save();
        }
    }
}
