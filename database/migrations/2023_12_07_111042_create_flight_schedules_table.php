<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('direction_id')->unsigned();
            $table->bigInteger('airplane_id')->unsigned();
            $table->bigInteger('flight_status_id')->unsigned();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('airplane_id')->references('id')->on('airplanes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('flight_status_id')->references('id')->on('flight_status')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('flight_schedules');
    }
};
