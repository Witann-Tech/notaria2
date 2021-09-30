<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datings = [
            ['name' => 'Escritura1', 'description' => 'Realizar escrituras', 'customer_id' => '1', 'dating_time' => '2020-10-13 00:30:00'],
            ['name' => 'Escritura2', 'description' => 'Realizar escrituras', 'customer_id' => '2', 'dating_time' => '2020-10-13 13:00:00'],
            ['name' => 'Escritura3', 'description' => 'Realizar escrituras', 'customer_id' => '3', 'dating_time' => '2020-10-14 09:30:00'],
            ['name' => 'Escritura4', 'description' => 'Realizar escrituras', 'customer_id' => '4', 'dating_time' => '2020-10-14 11:00:00'],
            ['name' => 'Escritura5', 'description' => 'Realizar escrituras', 'customer_id' => '5', 'dating_time' => '2020-10-15 00:30:00'],
        ];
        DB::table('datings')->insert($datings);
    }
}
