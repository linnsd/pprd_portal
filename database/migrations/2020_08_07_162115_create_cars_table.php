<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('car_type');
            $table->string('no');
            $table->integer('sd_id');
            $table->integer('driver_id');
            $table->string('plate_no');
            $table->string('model');
            $table->string('type');
            $table->string('fuel_type');
            $table->string('capacity');
            $table->integer('unit_id');
            $table->string('mine_no');
            $table->string('oil_carry');
            $table->string('oil_carry_back');
            // $table->string('wheels');
            $table->string('weight');
            $table->string('power');
            $table->string('issue_date');
            $table->date('expire_date');
            $table->string('eng_no');
            $table->string('chassis_no');
            // $table->string('color');
            $table->string('owner_book_photo');
            $table->string('licence_photo_f');
            $table->string('licence_photo_b');

            $table->string('car_f_photo');
            $table->string('car_b_photo');
            $table->string('eng_photo');
            $table->string('head_room_photo');
            $table->string('ka_nya_na_photo');
            $table->string('mine_licence_photo')

            $table->string('path');

            $table->string('company_name');
            $table->string('fuel_type');
            $table->string('address');
            $table->boolean('locked')->defautl(0);

            $table->integer('user_id')->nullable();
            $table->string('addedBy')->nullable();


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
        Schema::dropIfExists('cars');
    }
}
