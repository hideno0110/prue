<?php

use Illuminate\Database\Seeder;
use App\FbaInventory;

class FbaInventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      for ($i=1; $i < 100; $i++) {
        FbaInventory::create([
          'date' => '2016-11-10',
          'fnsku' => 'fnsku'.$i,
          'sku' => "sku".$i,
          'name' => 'sample', 
          'number' => '12',
          'fc' => 'fc',
          'status' => '1',
          'country' => 'japan',
        ]);
      }
    }
}
