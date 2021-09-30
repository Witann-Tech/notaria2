<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StepStatusesSeeder::class);
        $this->call(FormalitieStatusSeeder::class);
        $this->call(ParticipantTypeSeeder::class);
        $this->call(AprobationTypeSeeder::class);
        $this->call(FormalitieTypeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(DatingSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(ExpendientSeeder::class);
        $this->call(FormalitieSeeder::class);
    }
}
