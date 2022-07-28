<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('licence_name');
            $table->string('licence_price');
            $table->string('extend_price');
            $table->string('expire_price');
            $table->string('destroy_price');
            $table->string('change_owner');
            $table->string('upgrade_storage');
            $table->string('change_name');
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
        Schema::dropIfExists('licences');
    }
}
