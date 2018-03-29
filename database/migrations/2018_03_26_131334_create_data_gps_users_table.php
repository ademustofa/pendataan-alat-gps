<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataGpsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gps_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_gps');
            $table->string('model_gps');
            $table->string('gps_name');
            $table->integer('waranty_month');
            $table->dateTime('buy_date')->nullable();
            $table->dateTime('sold_date')->nullable();
            $table->integer('sold_to')->nullable();
            $table->string('photo');
            $table->string('description');
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
        Schema::dropIfExists('gps_users');
    }
}
