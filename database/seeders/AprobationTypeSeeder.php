<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AprobationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name" => "Ningúno"],
            ["name" => "Aprovación superior"],
            ["name" => "Carga de documentación"],
            ["name" => "Por tiempo"]
        ];
        DB::table('aprobation_types')->insert($types);
    }
}
