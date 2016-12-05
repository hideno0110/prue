<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->unsigned()->index();
            $table->integer('item_master_id')->unsigned()->index();
            $table->integer('photo_id')->unsigned()->index()->default(0);
            $table->string('asin');
            $table->string('jan_code');
            $table->string('sku')->default('');
            $table->string('name')->nullable();
            $table->integer('shop_id')->index()->unsigned()->nullable();
            $table->date('buy_date')->nullable();
            $table->integer('number')->default(0);
            $table->integer('buy_price')->default(0);
            $table->integer('sell_price')->default(0);
            $table->integer('payment_id')->unsigned()->index()->nullable();
            $table->integer('condition_id')->unsigned()->index()->nullable();
            $table->integer('sale_place_id')->unsigned()->index()->nullable();
            $table->text('description')->nullable();
            $table->text('description_1')->nullable();
            $table->text('description_2')->nullable();
            $table->text('memo')->nullable();
            $table->text('ebay_id')->nullable();
            $table->text('ebay_memo')->nullable();
            $table->integer('free')->nullable();
            $table->text('free_memo')->nullable();
            $table->text('sku2')->nullable();
            $table->integer('shipping_type')->default(0);
            $table->integer('is_active')->default(0);
            $table->integer('update_admin_id')->unsigned()->index();
            $table->timestamps();
            //foreign key
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            // $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            // $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            // $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
            // $table->foreign('sale_place_id')->references('id')->on('sale_places')->onDelete('cascade');
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventories');
    }
}
