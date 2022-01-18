<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'nameDe' => "Elektriker",
            'nameIt' => "eletricista",
            'nameEn' => "electrician",
        ]);
        DB::table('tags')->insert([
            'nameDe' => "Hydrauliker",
            'nameIt' => "Idraulico",
            'nameEn' => "hydraulic engineer",
        ]);
        DB::table('tags')->insert([
            'nameDe' => "Maler",
            'nameIt' => "pittore",
            'nameEn' => "painter",
        ]);
    }
}
