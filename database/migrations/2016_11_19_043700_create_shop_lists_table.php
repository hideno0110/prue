<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopListsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->text('shop_name');
            $table->integer('merchant_id')->index();
            $table->integer('is_active')->default(0);
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
        Schema::drop('shop_lists');
    }
}
