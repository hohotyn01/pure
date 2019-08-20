<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_extras', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->boolean('inside_fridge');
            $table->boolean('inside_oven');
            $table->boolean('garage_swept');
            $table->boolean('blinds_cleaning');
            $table->boolean('laundry_wash_dry');
            $table->boolean('service weekend');
            $table->boolean('carpet');
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
        Schema::dropIfExists('order_extras');
    }
}
