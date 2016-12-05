<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvPhotos extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('type')->default(0);
            $table->integer('inventory_id')->default(0);  
            $table->integer('number')->default(0);                
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
        Schema::drop('inv_photos');
    }
}
