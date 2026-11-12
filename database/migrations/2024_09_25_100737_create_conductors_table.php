<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('bus_id')->nullable(); // Foreign key to buses table (if a conductor is assigned to a bus)
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete to retain deleted records
            
            // Foreign key constraints
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Linking conductor to the users table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductors');
    }
}
