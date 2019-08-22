<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table){
            $table->string('bedroom')->nullable()->change();
            $table->string('bathroom')->nullable()->change();
            $table->string('cleaning_frequency')->nullable()->change();
            $table->string('cleaning_type')->nullable()->change();
            $table->string('cleaning_date')->nullable()->change();
            $table->integer('home_footage')->nullable()->change();
            $table->string('street_address', 150)->nullable()->change();
            $table->string('city', 150)->nullable()->change();
            $table->string('zip_code', 10)->nullable()->change();
            $table->integer('per_cleaning')->nullable()->change();
            $table->integer('total_sum')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table){
            $table->string('bedroom')->change();
            $table->string('bathroom')->change();
            $table->string('cleaning_frequency')->change();
            $table->string('cleaning_type')->change();
            $table->string('cleaning_date')->change();
            $table->integer('home_footage')->change();
            $table->string('street_address', 150)->change();
            $table->string('city', 150)->change();
            $table->string('zip_code', 10)->change();
            $table->integer('per_cleaning')->default('0')->change();
            $table->integer('total_sum')->default('0')->change();
            $table->string('status')->change();
        });
    }
}
