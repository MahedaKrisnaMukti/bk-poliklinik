<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Faker\Factory;

use App\Models\Doctor;
use App\Models\Poli;
use App\Models\User;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $user = User::create([
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('doctor'),
        ]);

        $user->assignRole('Dokter');

        $phoneNumber = $faker->e164PhoneNumber();
        $phoneNumber = str_replace('+', '', $phoneNumber);
        $phoneNumber = '8' . $phoneNumber;

        $poli = Poli::first();

        Doctor::create([
            'user_id' => $user->id,
            'poli_id' => $poli->id,
            'name' => 'Dokter Ruthboyy',
            'address' => $faker->address(),
            'phone_number' => $phoneNumber,
        ]);
    }
}
