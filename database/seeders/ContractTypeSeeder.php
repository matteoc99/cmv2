<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contract_types')->insert([
            'nameDe' => "Dienstleistungsvertrag",
            'nameIt' => "contratto di servizio",
            'nameEn' => "service contract",
        ]);
        DB::table('contract_types')->insert([
            'nameDe' => "Fester Preis",
            'nameIt' => "prezzo fisso",
            'nameEn' => "fixed price",
        ]);
        DB::table('contract_types')->insert([
            'nameDe' => "Kostenvoranschlag notwendig",
            'nameIt' => "preventivo necessario",
            'nameEn' => "estimate necessary",
        ]);
        DB::table('contract_types')->insert([
            'nameDe' => "Kostenvoranschlag nicht notwendig",
            'nameIt' => "preventivo non necessario",
            'nameEn' => "estimate not necessary",
        ]);
    }
}
