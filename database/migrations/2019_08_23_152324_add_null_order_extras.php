<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullOrderExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_extras', function (Blueprint $table){
            $table->boolean('inside_fridge')->nullable()->change();
            $table->boolean('inside_oven')->nullable()->change();
            $table->boolean('garage_swept')->nullable()->change();
            $table->boolean('blinds_cleaning')->nullable()->change();
            $table->boolean('laundry_wash_dry')->nullable()->change();
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
            $table->boolean('inside_fridge')->change();
            $table->boolean('inside_oven')->change();
            $table->boolean('garage_swept')->change();
            $table->boolean('blinds_cleaning')->change();
            $table->boolean('laundry_wash_dry')->change();
        });
    }
}
