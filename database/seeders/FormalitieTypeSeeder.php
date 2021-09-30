<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormalitieTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name" => "Compra Venta", "description" => "Detalle de compra venta"],
            ["name" => "Divorcio", "description" => "Termino de matrimonio"],
            ["name" => "Herencia", "description" => "pass"]
        ];
        $steps = [
            //compra venta
            ["name" => "A", "description" => "Subir documentos", "formalitie_type_id"=>1, "min_days"=>1, "max_days"=>5, "aprobation_type_id"=>1],
            ["name" => "B", "description" => "Tomar fotos", "formalitie_type_id"=>1, "min_days"=>null, "max_days"=>null, "aprobation_type_id"=>2],
            ["name" => "C", "description" => "Ir a las firmas", "formalitie_type_id"=>1, "min_days"=>1, "max_days"=>10, "aprobation_type_id"=>3],
            ["name" => "D", "description" => "Pagar", "formalitie_type_id"=>1, "min_days"=>null, "max_days"=>null, "aprobation_type_id"=>1],
            ["name" => "E", "description" => "Recoger documentos", "formalitie_type_id"=>1, "min_days"=>1, "max_days"=>5, "aprobation_type_id"=>3],
            //divorcio
            ["name" => "A", "description" => "Subir documentos", "formalitie_type_id"=>2, "min_days"=>1, "max_days"=>5, "aprobation_type_id"=>1],
            ["name" => "B", "description" => "Subir documentos", "formalitie_type_id"=>2, "min_days"=>null, "max_days"=>5, "aprobation_type_id"=>2],
            ["name" => "C", "description" => "Subir documentos", "formalitie_type_id"=>2, "min_days"=>null, "max_days"=>null, "aprobation_type_id"=>1],
            //herencia
            ["name" => "A", "description" => "Subir documentos", "formalitie_type_id"=>3, "min_days"=>null, "max_days"=>null, "aprobation_type_id"=>2],
            ["name" => "B", "description" => "Subir documentos", "formalitie_type_id"=>3, "min_days"=>1, "max_days"=>5, "aprobation_type_id"=>1],
        ];
        $participants = [
            //participantes del tramite compraventa
            ["quantity"=>'2', "step_id"=>'1', "participant_type_id"=>'1',"formalitie_type_id"=>'1'],
            ["quantity"=>'1', "step_id"=>'2', "participant_type_id"=>'5',"formalitie_type_id"=>'1'],
            ["quantity"=>'3', "step_id"=>'2', "participant_type_id"=>'7',"formalitie_type_id"=>'1'],
            ["quantity"=>'1', "step_id"=>'3', "participant_type_id"=>'4',"formalitie_type_id"=>'1'],
            //participantes de divorcio
            ["quantity"=>'1', "step_id"=>'7', "participant_type_id"=>'2',"formalitie_type_id"=>'2'],
            ["quantity"=>'1', "step_id"=>'7', "participant_type_id"=>'1',"formalitie_type_id"=>'2'],
            ["quantity"=>'1', "step_id"=>'7', "participant_type_id"=>'4',"formalitie_type_id"=>'2'],
            ["quantity"=>'4', "step_id"=>'7', "participant_type_id"=>'7',"formalitie_type_id"=>'2'],
            ["quantity"=>'3', "step_id"=>'7', "participant_type_id"=>'3',"formalitie_type_id"=>'2'],
        ];
        DB::table('formalitie_types')->insert($types);
        DB::table('formalitie_type_steps')->insert($steps);
        DB::table('formalitie_type_step_participants')->insert($participants);
    }
}
