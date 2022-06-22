<?php

namespace Database\Seeders;

use App\Models\InvoiceStatus;
use App\Models\Invoices;
use App\Models\PaymentServices;
use App\Models\WorkServices;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Invoices::factory(20)->create();
        InvoiceStatus::factory(20)->create();
        PaymentServices::factory(20)->create();
        WorkServices::factory(20)->create();

    }
}
