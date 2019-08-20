<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->string('cleaning_frequency');
            $table->string('cleaning_type');
            $table->string('cleaning_date');
            $table->integer('home_footage');
            $table->string('street_address', 150);
            $table->string('apt', 15)->nullable();
            $table->string('city', 150);
            $table->string('zip_code', 10);
            $table->integer('per_cleaning')->default('0');
            $table->integer('total_sum')->default('0');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
