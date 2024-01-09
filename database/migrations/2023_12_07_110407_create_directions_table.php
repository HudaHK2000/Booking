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
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_airport_code');
            $table->unsignedBigInteger('destination_airport_code');
            $table->foreign('origin_airport_code')->references('id')->on('airports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('destination_airport_code')->references('id')->on('airports')->onDelete('cascade')->onUpdate('cascade');
            // $table->primary(['origin_airport_code', 'destination_airport_code']);
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
        Schema::dropIfExists('directions');
    }
};
