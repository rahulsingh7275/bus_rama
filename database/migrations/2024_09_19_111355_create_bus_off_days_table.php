<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusOffDaysTable extends Migration
{
    public function up()
    {
        Schema::create('bus_off_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            $table->date('off_date');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bus_off_days');
    }
}