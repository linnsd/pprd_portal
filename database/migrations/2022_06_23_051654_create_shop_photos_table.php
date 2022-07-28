<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->boolean('type')->nullable();
            $table->string('photo_name');
            $table->string('path');
            $table->string('name');
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
        Schema::dropIfExists('shop_photos');
    }
}
