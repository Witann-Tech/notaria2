<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Admin", 'level' => 1],
            ["name" => "Abodago", 'level' => 2],
            ["name" => "Cliente", 'level' => 3]
        ];

        DB::table('roles')->insert($roles);
    }
}
