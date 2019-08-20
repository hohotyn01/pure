<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderMaterialsCountertops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_materials_countertops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->boolean('concrete');
            $table->boolean('quartz');
            $table->boolean('formica');
            $table->boolean('granite');
            $table->boolean('marble');
            $table->boolean('tile');
            $table->boolean('paper_stone');
            $table->boolean('butcher_block');
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
        Schema::dropIfExists('order_materials_countertops');
    }
}
