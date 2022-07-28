<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopPreorderFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_preorder_fuel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pre_shop_id');
            $table->integer('pre_comp_name');
            $table->integer('pre_fuel_type');
            $table->integer('pre_capacity');
            $table->date('pre_arrival_date');
            $table->date('pre_received_date')->nullable();
            $table->tinyInteger('pre_status')->nullable()->comment("Null= Prder Order, 1= Received,2=cancel");
            $table->string('pre_remark')->nullable();
            $table->string('terminal');
            $table->integer('bowser_pre_no');
            $table->string('bowser_pre_char');
            $table->integer('car_no');
            $table->string('bowser_no');
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
        Schema::dropIfExists('shop_preorder_fuel');
    }
}
