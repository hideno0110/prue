<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopMapsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('shop');
            $table->string('shop_category');
            $table->string('shop_branch');
            $table->string('postal_code');
            $table->string('prefecture');
            $table->string('address1');
            $table->string('address2');
            $table->string('tel');
            $table->string('url');
            $table->string('time');
            $table->double('lat')->default(0);
            $table->double('lng')->default(0);
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
        Schema::dropIfExists('shop_maps');
    }
}
