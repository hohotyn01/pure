<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderMaterialsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_materials_details', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->boolean('stainless_steel_appliances');
            $table->boolean('stove_type');
            $table->boolean('shawer_doors_glass');
            $table->boolean('mold');
            $table->string('areas_special_attention')->nullable()->default('');
            $table->string('anything_know')->nullable()->default('');
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
        Schema::dropIfExists('order_materials_details');
    }
}
