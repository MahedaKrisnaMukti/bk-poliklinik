<?php

namespace Database\Seeders;

use App\Models\CheckupSchedule;
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

        // * Dokter 1
        $user = User::create([
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('doctor'),
        ]);

        $user->assignRole('Dokter');

        $phoneNumber = $faker->e164PhoneNumber();
        $phoneNumber = str_replace('+', '', $phoneNumber);
        $phoneNumber = '8' . $phoneNumber;

        $poli = Poli::first();

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'poli_id' => $poli->id,
            'name' => 'Dokter Ruthboyy',
            'address' => $faker->address(),
            'phone_number' => $phoneNumber,
        ]);

        CheckupSchedule::create([
            'doctor_id' => $doctor->id,
            'poli_id' => $doctor->poli_id,
            'day' => 'Jumat',
            'start_time' => '08:00:00',
            'end_time' => '22:59:00',
        ]);

        // * Dokter 2
        $user = User::create([
            'email' => 'doctor2@gmail.com',
            'password' => Hash::make('doctor2'),
        ]);

        $user->assignRole('Dokter');

        $phoneNumber = $faker->e164PhoneNumber();
        $phoneNumber = str_replace('+', '', $phoneNumber);
        $phoneNumber = '8' . $phoneNumber;

        $poli = Poli::first();

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'poli_id' => $poli->id,
            'name' => 'Dokter Krisna',
            'address' => $faker->address(),
            'phone_number' => $phoneNumber,
        ]);

        CheckupSchedule::create([
            'doctor_id' => $doctor->id,
            'poli_id' => $doctor->poli_id,
            'day' => 'Senin',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ]);
    }
}
