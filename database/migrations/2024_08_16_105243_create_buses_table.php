<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('route_name');
            $table->unsignedBigInteger('from_station_id');
            $table->unsignedBigInteger('to_station_id');
            $table->unsignedBigInteger('pickup_id');
            $table->unsignedBigInteger('drop_id');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('travel_duration');
            $table->integer('number_of_sleeper_seats')->default(0);
            $table->integer('number_of_non_sleeper_seats')->default(0);
            $table->integer('number_of_seats')->default(0);
            $table->integer('sleeper_fare')->default(0);
            $table->integer('fare');
            $table->string('bus_type');
            $table->string('facilites');
            $table->timestamps();
            
            // Add shorter foreign key constraint names
            // $table->foreign('from_station_id')->references('id')->on('bus_stations')->onDelete('cascade');
            // $table->foreign('to_station_id')->references('id')->on('bus_stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
