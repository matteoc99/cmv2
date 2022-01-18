<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('urgencies')->insert([
            'nameDe' => "Nicht Dringend",
            'nameIt' => "Non Urgente",
            'nameEn' => "Not urgent",
            'value' => 0,
        ]);
        DB::table('urgencies')->insert([
            'nameDe' => "Dringend",
            'nameIt' => "Urgente",
            'nameEn' => "urgent",
            'value' => 100,
        ]);
    }
}
