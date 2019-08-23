<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnOrderExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_extras', function (Blueprint $table){
            $table->string('service_weekend', 5)->change();
            $table->string('carpet', 5)->change();
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
            $table->boolean('service_weekend')->change();
            $table->boolean('carpet')->change();
        });
    }
}
