<?php

use Illuminate\Database\Seeder;
use App\MwsSell;
use Kyslik\ColumnSortable\Sortable;
class MwsSellTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

      for ($i=1; $i < 100; $i++) {
        MwsSell::create([
          'settlement-id' => 1,
          'settlement-start-date' => 'bbb',
          'settlement-end-date' => 'ccc',
          'deposit-date' => 'ddd',
          'total-amount' => '111',
          'currency' => '',
          'transaction-type' => '',
          'order-id' => '',
          'merchant-order-id' => '',
          'adjustment-id' => '',
          'shipment-id' => '',
          'marketplace-name' => '',
          'shipment-fee-type' => '',
          'shipment-fee-amount' => '',
          'order-fee-type' => '',
          'order-fee-amount' => '',
          'fulfillment-id' => '',
          'posted-date' => '2016-11-10',
          'order-item-code' => $i,
          'merchant-order-item-id' => '',
          'merchant-adjustment-item-id' => '',
          'sku' => "sku".$i+100,
          'quantity-purchased' => '',
          'price-type' => '',
          'price-amount' => '1111'+$i*100,
          'item-related-fee-type' => '',
          'item-related-fee-amount' => $i*10,
          'misc-fee-amount' => '',
          'other-fee-amount' => '',
          'other-fee-reason-description' => '',
          'promotion-id' => '',
          'promotion-type' => '',
          'promotion-amount' => '',
          'direct-payment-type' => '',
          'direct-payment-amount' => '',
          'other-amount' => '',
        ]);
      }
    }
}
