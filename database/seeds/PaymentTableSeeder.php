<?php

use Illuminate\Database\Seeder;
use App\Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

       //
    }
}
