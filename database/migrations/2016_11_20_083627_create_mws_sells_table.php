<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMwsSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mws_sells', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('settlement-id');
            $table->text('settlement-start-date');
            $table->text('settlement-end-date');
            $table->text('deposit-date');
            $table->text('total-amount');
            $table->text('currency');
            $table->text('transaction-type');
            $table->text('order-id');
            $table->text('merchant-order-id');
            $table->text('adjustment-id');
            $table->text('shipment-id');
            $table->text('marketplace-name');
            $table->text('shipment-fee-type');
            $table->text('shipment-fee-amount');
            $table->text('order-fee-type');
            $table->text('order-fee-amount');
            $table->text('fulfillment-id');
            $table->text('posted-date');
            $table->text('order-item-code');
            $table->text('merchant-order-item-id');
            $table->text('merchant-adjustment-item-id');
            $table->text('sku');
            $table->text('quantity-purchased');
            $table->text('price-type');
            $table->text('price-amount');
            $table->text('item-related-fee-type');
            $table->text('item-related-fee-amount');
            $table->text('misc-fee-amount');
            $table->text('other-fee-amount');
            $table->text('other-fee-reason-description');
            $table->text('promotion-id');
            $table->text('promotion-type');
            $table->text('promotion-amount');
            $table->text('direct-payment-type');
            $table->text('direct-payment-amount');
            $table->text('other-amount');
            $table->timestamps();  //2016/11 add


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mws_sells');
    }
}
