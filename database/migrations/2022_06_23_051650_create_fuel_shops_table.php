<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sd_id');
            $table->integer('tsh_id');
            $table->string('shopName');
            $table->string('owner');
            $table->string('address');
            $table->double('lat');
            $table->double('lng');
            $table->integer('licence_id');
            $table->string('licence_no');
            $table->boolean('shop_type')->comment("0=minor, 1= majaor");
            $table->tinyInteger('shop_status')->comment("1= Active, 2= Temp_Closed,3= Permanently Closed.");
            $table->date('lic_issue_date');
            $table->date('lic_expire_date');
            $table->string('remark');
            // lic_grade
            $table->integer('lic_grade')->nullable();
            $table->string('c_by')->nullable();
            $table->string('u_by')->nullable();
            $table->boolean('show_status')->default(1);
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
        Schema::dropIfExists('fuel_shops');
    }
}
