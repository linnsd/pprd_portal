<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopDailyRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_daily_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('max_capacity');
            $table->integer('fuel_type');
            $table->integer('fuel_balance');
            $table->integer('daily_sale_capacity');
            $table->integer('avg_sale_capacity');
            $table->integer('available_day');
            $table->string('remark');
            $table->boolean('dio_approve');
            $table->boolean('admin_approve');
            $table->date('arrival_date')->nullable();
            $table->integer('pre_order_capacity')->nullable();
            $table->date_time('dio_approve_date')->nullable();
            $table->date_time('admin_approve_date')->nullable();
            $table->string('dio_approve_name')->nullable();
            $table->string('admin_approve_name')->nullable();
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
        Schema::dropIfExists('shop_daily_record');
    }
}
