<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->integer('sd_id');
            $table->integer('tsh_id');
            $table->string('company_no');
            $table->integer('grade_id');
            $table->integer('licence_id');
            $table->string('shop_name');
            $table->string('owner');
            $table->string('licence_no')->unique();
            $table->string('fuel_type');
            $table->string('gasoline');
            $table->string('diesel');
            $table->string('storage');
            $table->date('issue_date');
            $table->date('expire_date');
            $table->text('location');
            $table->string('lat');
            $table->string('lng');

            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();;
            $table->string('photo3')->nullable();;
            $table->string('photo4')->nullable();;
            $table->string('photo5')->nullable();;
            $table->string('path')->nullable();;
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
        Schema::dropIfExists('shops');
    }
}
