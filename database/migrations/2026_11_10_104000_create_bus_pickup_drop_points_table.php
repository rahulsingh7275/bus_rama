<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusPickupDropPointsTable extends Migration
{
    public function up()
    {
        Schema::create('bus_pickup_drop_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_station_id');
            $table->string('name');
            $table->string('address');
            $table->timestamps();

            $table->foreign('bus_station_id')->references('id')->on('bus_stations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bus_pickup_drop_points');
    }
}
