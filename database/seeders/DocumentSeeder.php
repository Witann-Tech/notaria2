<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name" => "Comprobante de domicilio", "description" => "Recibo de luz, agua, predial"],
            ["name" => "Cedula de identidad", "description" => "INE, IFE, Pasaporte, Licencia de conducir"],
            ["name" => "Estado de cuenta", "description" => "Emitida por el banco"]
        ];
        DB::table('documents')->insert($types);
    }
}
