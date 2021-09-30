<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormalitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name"=> "primero", "description" => "Tramite de ejemplo", "expedient_id" => 1, "formalitie_type_id" => 1, "user_id" => 1],
            ["name"=> "segundo", "description" => "Tramite de ejemplo", "expedient_id" => 1, "formalitie_type_id" => 2, "user_id" => 1],
            ["name"=> "tercero", "description" => "Tramite de ejemplo", "expedient_id" => 1, "formalitie_type_id" => 3, "user_id" => 1]
        ];
        $steps = [
            ['formalitie_id'=>1, 'formalitie_type_step_id'=>6, 'step_status_id'=>1],
            ['formalitie_id'=>1, 'formalitie_type_step_id'=>7, 'step_status_id'=>2],
            ['formalitie_id'=>1, 'formalitie_type_step_id'=>8, 'step_status_id'=>2],

            ['formalitie_id'=>2, 'formalitie_type_step_id'=>4, 'step_status_id'=>1],
            ['formalitie_id'=>2, 'formalitie_type_step_id'=>5, 'step_status_id'=>2],
            ['formalitie_id'=>2, 'formalitie_type_step_id'=>6, 'step_status_id'=>2],
            ['formalitie_id'=>2, 'formalitie_type_step_id'=>7, 'step_status_id'=>2],
            ['formalitie_id'=>2, 'formalitie_type_step_id'=>8, 'step_status_id'=>2],

            ['formalitie_id'=>3, 'formalitie_type_step_id'=>6, 'step_status_id'=>1],
        ];
        DB::table('formalities')->insert($types);
        DB::table('formalitie_steps')->insert($steps);
    }
}
