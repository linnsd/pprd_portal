<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenceFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lic_name_id');
            $table->integer('lic_grade_id');
            $table->string('lic_key');
            $table->string('lic_fee_val');
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
        Schema::dropIfExists('licence_fees');
    }
}
