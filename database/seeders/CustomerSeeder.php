<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['rol_id' => 2, 'name' => 'Daniel', 'email' => 'daniel@gmail.com', 'password' => bcrypt("12345678")],
            ['rol_id' => 2, 'name' => 'Hector', 'email' => 'hector@gmail.com', 'password' => bcrypt("12345678")],
            ['rol_id' => 2, 'name' => 'Claudia', 'email' => 'claudia@gmail.com', 'password' => bcrypt("12345678")],
            ['rol_id' => 2, 'name' => 'Pedro', 'email' => 'pedrol@gmail.com', 'password' => bcrypt("12345678")],
            ['rol_id' => 2, 'name' => 'Cesar', 'email' => 'cesar@gmail.com', 'password' => bcrypt("12345678")]
        ];
        DB::table('users')->insert($users);
        $customers = [
            [
                'lastname'     => 'Perez',
                'birthplace'  => 'Colima',
                'birthdate'    => '1990-10-13',
                'adress'       => 'Av Tulipanes #259',
                'phone'        => '312123123',
                'curp'         => '0917HPLRNB06',
                'RFC'          => '312123123',
                'job'          => 'Maestro',
                'civil_status' => 'Divorciado',
                'user_id'      => 2,
            ],
            [
                'lastname'     => 'Lopez',
                'birthplace'  => 'Colima',
                'birthdate'    => '1990-10-13',
                'adress'       => 'Av Tulipanes #259',
                'phone'        => '312123123',
                'curp'         => '0917HPLRNB06',
                'RFC'          => '312123123',
                'job'          => 'Maestro',
                'civil_status' => 'Divorciado',
                'user_id'      => 3,
            ],
            [
                'lastname'     => 'Jiménez',
                'birthplace'  => 'Colima',
                'birthdate'    => '1990-10-13',
                'adress'       => 'Av Tulipanes #259',
                'phone'        => '312123123',
                'curp'         => '0917HPLRNB06',
                'RFC'          => '312123123',
                'job'          => 'Maestro',
                'civil_status' => 'Divorciado',
                'user_id'      => 4,
            ],
            [
                'lastname'     => 'Guzmán',
                'birthplace'  => 'Colima',
                'birthdate'    => '1990-10-13',
                'adress'       => 'Av Tulipanes #259',
                'phone'        => '312123123',
                'curp'         => '0917HPLRNB06',
                'RFC'          => '312123123',
                'job'          => 'Maestro',
                'civil_status' => 'Divorciado',
                'user_id'      => 5,
            ],
            [
                'lastname'     => 'Solis',
                'birthplace'  => 'Colima',
                'birthdate'    => '1990-10-13',
                'adress'       => 'Av Tulipanes #259',
                'phone'        => '312123123',
                'curp'         => '0917HPLRNB06',
                'RFC'          => '312123123',
                'job'          => 'Maestro',
                'civil_status' => 'Divorciado',
                'user_id'      => 6,
            ],
        ];
        DB::table('customers')->insert($customers);
    }
}
