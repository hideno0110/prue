<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminContactsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->integer('admin_id');
            $table->string('subject');
            $table->text('content');
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
        Schema::dropIfExists('admin_contacts');
    }
}
