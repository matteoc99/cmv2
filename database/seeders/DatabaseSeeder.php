<?php

namespace Database\Seeders;

use App\Models\ContractType;
use App\Models\PaymentPlatform;
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
        $this->call(RoleSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(UrgencySeeder::class);
        $this->call(ContractTypeSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(PaymentPlatformSeeder::class);

    }
}
