<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopFuelCapacityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_fuel_capacity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('fuel_type');
            $table->integer('max_capacity');
            $table->integer('opening_balance');
            $table->integer('avg_balance');
            $table->boolean('show_status')->default(1);
            $table->boolean('lock_unlock')->default(1);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_fuel_capacity');
    }
}
