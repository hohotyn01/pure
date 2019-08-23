<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullOrderMaterialsFloors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_materials_floors', function (Blueprint $table){
            $table->boolean('hardwood')->nullable()->change();
            $table->boolean('cork')->nullable()->change();
            $table->boolean('vinyl')->nullable()->change();
            $table->boolean('concrete')->nullable()->change();
            $table->boolean('carpet')->nullable()->change();
            $table->boolean('natural_stone')->nullable()->change();
            $table->boolean('tile')->nullable()->change();
            $table->boolean('laminate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_extras', function (Blueprint $table){
            $table->boolean('hardwood')->change();
            $table->boolean('cork')->change();
            $table->boolean('vinyl')->change();
            $table->boolean('concrete')->change();
            $table->boolean('carpet')->change();
            $table->boolean('natural_stone')->change();
            $table->boolean('tile')->change();
            $table->boolean('laminate')->change();
        });
    }
}
