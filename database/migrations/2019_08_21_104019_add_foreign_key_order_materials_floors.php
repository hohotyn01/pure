<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOrderMaterialsFloors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_materials_floors', function (Blueprint $table){
            $table->bigInteger('order_id')->unsigned()->change();
        });
        Schema::table('order_materials_floors', function (Blueprint $table){
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_materials_floors', function (Blueprint $table){
            $table->integer('order_id')->change();
        });
    }
}
