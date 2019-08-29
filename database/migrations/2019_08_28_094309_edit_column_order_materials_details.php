<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnOrderMaterialsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_materials_details', function (Blueprint $table){
            $table->string('stainless_steel_appliances', 5)->change();
            $table->string('stove_type', 5)->change();
            $table->string('shawer_doors_glass', 5)->change();
            $table->string('mold', 5)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_materials_details', function (Blueprint $table){
            $table->boolean('stainless_steel_appliances')->change();
            $table->boolean('stove_type')->change();
            $table->boolean('shawer_doors_glass')->change();
            $table->boolean('mold')->change();
        });
    }
}
