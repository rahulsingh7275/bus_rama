<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('from_station_id');
            $table->unsignedBigInteger('to_station_id');
            $table->string('passenger_name');
            $table->integer('sleeper_passenger_count')->detault(0);
            $table->integer('non_sleeper_passenger_count')->detault(0);
            $table->integer('passenger_count');
            $table->date('travel_date');
            $table->integer('fare');
            $table->string('allotted_seat_number');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('ip_address');
            $table->timestamps();
            $table->softDeletes(); // Add this line for soft deletes

            // $table->foreign('from_station_id')->references('id')->on('bus_stations')->onDelete('cascade');
            // $table->foreign('to_station_id')->references('id')->on('bus_stations')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
