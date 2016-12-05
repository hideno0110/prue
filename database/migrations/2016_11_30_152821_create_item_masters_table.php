<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMastersTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_code');
            $table->string('asin');
            $table->string('name');
            $table->text('item_detail');
            $table->string('category');
            $table->string('rank');
            $table->string('file');
            $table->integer('merchant_id')->unsigned()->index();

            $table->timestamps();
        });
    }

    /**
     *a マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_masters');
    }
}
