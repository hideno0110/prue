<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssUrlsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->index();
            $table->string('url');
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
        Schema::dropIfExists('rss_urls');
    }
}
