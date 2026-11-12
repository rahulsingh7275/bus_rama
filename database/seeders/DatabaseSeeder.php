<?php

use Illuminate\Database\Seeder;
use Database\Seeders\PaymentSettingsSeeder;
use Database\Seeders\UsersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentSettingsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}