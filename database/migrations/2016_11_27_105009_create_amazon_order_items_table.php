<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOrderItemsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_order_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('amazon_order_table_id');
          $table->string('sku');
          $table->string('item_name');
          $table->integer('amount');
          $table->integer('price');
          $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amazon_order_items');
    }
}
