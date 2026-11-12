<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_setting', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_contact');
            $table->string('company_email');
            $table->string('company_address');
            $table->string('ticket_prefix');
            // $table->string('payment_gateway');
            // $table->string('payment_gateway_mode');
            // $table->string('payment_gateway_contact',10);
            $table->string('logo');
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
        Schema::dropIfExists('website_setting');
    }
}
