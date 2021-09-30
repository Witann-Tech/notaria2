<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ["name" => "Abogado", "is_customer" => 0],
            ["name" => "Administrativo", "is_customer" => 0],
            ["name" => "Contador", "is_customer" => 0],
            ["name" => "Comprador", "is_customer" => 1],
            ["name" => "Demandante", "is_customer" => 1],
            ["name" => "Vendedor", "is_customer" => 1],
            ["name" => "Testigo", "is_customer" => 1],
        ];
        DB::table('participant_types')->insert($types);
    }
}
