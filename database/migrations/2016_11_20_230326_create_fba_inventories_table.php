<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbaInventoriesTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {

        Schema::create('fba_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->text('fnsku');
            $table->text('sku');
            $table->text('name')->nullable();
            $table->integer('number')->default(0);
            $table->text('fc');
            $table->text('status');
            $table->text('country');
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
        Schema::drop('fba_inventories');
    }
}
