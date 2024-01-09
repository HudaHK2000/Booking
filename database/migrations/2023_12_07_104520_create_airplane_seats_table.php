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
        Schema::create('airplane_seats', function (Blueprint $table) {
            $table->id();
            $table->string('seat_id');
            $table->bigInteger('airplane_id')->unsigned();
            $table->bigInteger('travel_class_id')->unsigned();
            $table->foreign('airplane_id')->references('id')->on('airplanes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('travel_class_id')->references('id')->on('travel_classes')->onDelete('cascade')->onUpdate('cascade');
            // $table->primary(['seat_id', 'airplane_id']);
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
        Schema::dropIfExists('airplane_seats');
    }
};
