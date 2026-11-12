<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupDropIdsToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_id')->nullable();
            $table->unsignedBigInteger('drop_id')->nullable();

            $table->foreign('pickup_id')->references('id')->on('bus_pickup_drop_points')->onDelete('set null');
            $table->foreign('drop_id')->references('id')->on('bus_pickup_drop_points')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['pickup_id']);
            $table->dropForeign(['drop_id']);
            $table->dropColumn(['pickup_id', 'drop_id']);
        });
    }
}
