<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('first_name', 150)->nullable()->change();
            $table->string('last_name', 150)->nullable()->change();
            $table->string('mobile_phone', 20)->nullable()->change();
            $table->string('lead_source', 150)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('first_name', 150)->change();
            $table->string('last_name', 150)->change();
            $table->string('mobile_phone', 20)->change();
            $table->string('lead_source', 150)->change();
        });
    }
}
