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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Passenger_id')->unsigned();
            $table->bigInteger('flight_seat_prices_id')->unsigned();
            $table->foreign('Passenger_id')->references('id')->on('passengers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('flight_seat_prices_id')->references('id')->on('flight_seat_prices')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bookings');
    }
};
