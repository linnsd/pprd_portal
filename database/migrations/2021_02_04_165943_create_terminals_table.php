<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->integer('sd_id');
            $table->integer('tsh_id');
            $table->string('location');
            $table->string('lic_no');
            $table->date('issue_date');
            $table->string('gasoline');
            $table->string('disel');
            $table->string('remark')->nullable();
            $table->string('nrc')->nullable();
            $table->string('comp_licence_no')->nullable();
            $table->string('comp_issue_date')->nullable();
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
        Schema::dropIfExists('terminals');
    }
}
