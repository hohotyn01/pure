<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->integer('order_id');
           $table->string('dogs_or_cats');
           $table->string('pets_total');
           $table->string('adults');
           $table->string('children');
           $table->integer('rate_cleanliness');
           $table->boolean('cleaned_2_months_ago');
           $table->string('differently');
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
        Schema::dropIfExists('order_details');
    }
}
