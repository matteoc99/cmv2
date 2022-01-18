<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'nameDe' => "Nicht Zugewiesen",
            'nameIt' => "Non Asegnato",
            'nameEn' => "Not Asigned",
        ]);

        DB::table('statuses')->insert([
            'nameDe' => "Zugewiesen",
            'nameIt' => "Asegnato",
            'nameEn' => "Asigned",
        ]);

        DB::table('statuses')->insert([
            'nameDe' => "In Arbeit",
            'nameIt' => "In Lavoro",
            'nameEn' => "work in progress",
        ]);

        DB::table('statuses')->insert([
            'nameDe' => "Fertiggestellt",
            'nameIt' => "Completato",
            'nameEn' => "Done",
        ]);
    }
}
