<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('gateway');
            $table->string('gateway_mode');
            $table->bigInteger('ticket_id');
            $table->string('contact')->nullable();
            $table->string('order_id')->unique(); // Razorpay Order ID
            $table->string('payment_id')->nullable(); // Razorpay Payment ID
            $table->string('currency')->default('INR');
            $table->unsignedBigInteger('amount'); // Amount in paisa (e.g., 10000 for 100.00 INR)
            $table->string('receipt')->nullable(); // Receipt ID for tracking
            $table->json('response')->nullable(); // Store complete Razorpay response in JSON format
            $table->string('status')->default('created'); // Payment status: created, successful, failed, etc.
            $table->string('refund_status')->nullable(); // Payment status: created, successful, failed, etc.
            $table->string('refund_amount')->nullable(); // Payment status: created, successful, failed, etc.
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
        Schema::dropIfExists('payments');
    }
}
