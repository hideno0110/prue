<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');   
            $table->text('tel');   
            $table->text('mail');   
            $table->text('postal_code');   
            $table->text('prefecture');  
            $table->text('city');                                 
            $table->text('address');
            $table->text('address2');
            $table->string('photo_id')->index()->nullable()->default(null);;
            $table->integer('is_active')->default(0);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
