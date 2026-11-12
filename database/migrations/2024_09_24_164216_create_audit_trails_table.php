<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditTrailsTable extends Migration
{
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->string('event'); // 'updated', 'deleted'
            $table->string('table_name'); // Table name where change occurred
            $table->unsignedBigInteger('record_id'); // The affected record's ID
            $table->json('old_data')->nullable(); // Old data before update
            $table->json('new_data')->nullable(); // New data after update
            $table->unsignedBigInteger('user_id')->nullable(); // The user who made the change (nullable if done by system)
            $table->timestamp('action_time'); // Time of action
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_trails');
    }
}
