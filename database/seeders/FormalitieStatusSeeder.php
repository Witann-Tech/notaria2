<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormalitieStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name" => "Activo"],
            ["name" => "Pausado"],
            ["name" => "Completado"],
            ["name" => "Cancelado"]
        ];
        DB::table('formalitie_statuses')->insert($types);
    }
}
