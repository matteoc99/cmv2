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
            'max_user' => 15,
            'max_ticket' => 40,
            'can_chat' => false,
        ]);
        DB::table('plans')->insert([
            'name' => "Basic",
            'price' => 9,
            'max_con' => 2,
            'max_user' => 45,
            'max_ticket' => 9999999,
            'can_chat' => false,
        ]);
        DB::table('plans')->insert([
            'name' => "Professional",
            'price' => 19,
            'max_con' => 5,
            'max_user' => 60,
            'max_ticket' => 9999999,
            'can_chat' => true,
        ]);
        DB::table('plans')->insert([
            'name' => "Business",
            'price' => 29,
            'max_con' => 9999999,
            'max_user' => 9999999,
            'max_ticket' => 9999999,
            'can_chat' => true,
        ]);
    }
}
