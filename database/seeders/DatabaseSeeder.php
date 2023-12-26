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
        $this->call([
            RoleSeeder::class,
            PoliSeeder::class,
            MedicineSeeder::class,
            AdminSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
