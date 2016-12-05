<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('merchant_id')->index()->unsigned();
            $table->integer('role_id')->index()->unsigned()->default(1);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('is_active')->default(1);
            $table->string('photo_id')->index()->nullable()->default(null);
            $table->timestamps();
            //foreign key
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
