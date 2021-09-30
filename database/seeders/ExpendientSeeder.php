<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpendientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [/* "user_id" => 1,  */"customer_id" => 1],
            [/* "user_id" => 1,  */"customer_id" => 2]
        ];
        DB::table('expedients')->insert($types);
    }
}
