<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullOrderMaterialsCountertops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_materials_countertops', function (Blueprint $table){
            $table->boolean('concrete')->nullable()->change();
            $table->boolean('quartz')->nullable()->change();
            $table->boolean('formica')->nullable()->change();
            $table->boolean('granite')->nullable()->change();
            $table->boolean('marble')->nullable()->change();
            $table->boolean('tile')->nullable()->change();
            $table->boolean('paper_stone')->nullable()->change();
            $table->boolean('butcher_block')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_materials_countertops', function (Blueprint $table){
            $table->boolean('concrete')->change();
            $table->boolean('quartz')->change();
            $table->boolean('formica')->change();
            $table->boolean('granite')->change();
            $table->boolean('marble')->change();
            $table->boolean('tile')->change();
            $table->boolean('paper_stone')->change();
            $table->boolean('butcher_block')->change();
        });
    }
}
