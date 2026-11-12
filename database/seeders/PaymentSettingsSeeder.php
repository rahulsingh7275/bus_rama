<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PaymentSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeders/sql/payment_settings.sql');
        DB::statement($sql);
    }
}
