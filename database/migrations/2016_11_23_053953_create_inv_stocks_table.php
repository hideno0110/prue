<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvStocksTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sku')->unsigned();
            $table->integer('stock');
            $table->timestamps();
        
            // $table->foreign('inventory_id')
            //       ->references('id')
            //       ->on('inventories')
            //       ->onDelete('cascade'); 
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_stocks');
    }
}
