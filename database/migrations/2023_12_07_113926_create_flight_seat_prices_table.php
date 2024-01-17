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
        Schema::create('flight_seat_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flight_id');
            $table->unsignedBigInteger('airplane_seat_id');
            $table->boolean('book')->default(0);
            $table->double('price');
            $table->foreign('flight_id')->references('id')->on('flight_schedules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('airplane_seat_id')->references('id')->on('airplane_seats')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('airplane_id')->references('airplane_id')->on('airplane_seats')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('seat_id')->references('seat_id')->on('airplane_seats')->onDelete('cascade')->onUpdate('cascade');
            // $table->primary(['flight_id','seat_id', 'airplane_id']);
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
        Schema::dropIfExists('flight_seat_prices');
    }
};
