<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('plans')->insert([
            'name' => "Free",
            'price' => 0,
            'max_con' => 1,
            'max_user' => 20,
            'max_ticket' => 40,
            'can_chat' => false,
            'can_documents' => false,
            'max_gb' => 0,
        ]);
        DB::table('plans')->insert([
            'name' => "Basic",
            'price' => 9,
            'max_con' => 3,
            'max_user' => 150,
            'max_ticket' => 9999999,
            'can_chat' => false,
            'can_documents' => true,
            'max_gb' => 1,
        ]);
        DB::table('plans')->insert([
            'name' => "Professional",
            'price' => 19,
            'max_con' => 20,
            'max_user' => 2000,
            'max_ticket' => 9999999,
            'can_chat' => true,
            'can_documents' => true,
            'max_gb' => 10,
        ]);
        DB::table('plans')->insert([
            'name' => "Business",
            'price' => 29,
            'max_con' => 9999999,
            'max_user' => 9999999,
            'max_ticket' => 9999999,
            'can_chat' => true,
            'can_documents' => true,
            'max_gb' => 20,
        ]);
    }
}
