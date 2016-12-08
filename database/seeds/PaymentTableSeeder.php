<?php

use Illuminate\Database\Seeder;
use App\Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {

        $payment1 = new Payment;
        $payment1->name = "現金";
        $payment1->save();       


        $pament2 = new Payment;
        $pament2->name = "クレジットカード";
        $pament2->save();       

        $pament3 = new Payment;
        $pament3->name = "ポイントカード";
        $pament3->save();    
       //
    }
}
