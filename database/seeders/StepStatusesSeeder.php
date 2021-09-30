<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepStatusesSeeder extends Seeder
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
            ["name" => "Pendiente"],
            ["name"=> "Pendiente de revisión"],
            ["name" => "Pendiente Aprobación"],
            ["name" => "Saltado"],
            ["name" => "Completado"],
            //["name" => "Cancelado"]
        ];
        DB::table('step_statuses')->insert($types);
    }
}
