<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportOilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_oil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->integer('sd_id');
            $table->string('location');
            $table->string('comp_lic_no');
            $table->date('comp_issue_date');
            $table->string('licence_no');
            $table->date('issue_date');
            $table->string('type');
            $table->string('capacity');
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
        Schema::dropIfExists('airport_oil');
    }
}
