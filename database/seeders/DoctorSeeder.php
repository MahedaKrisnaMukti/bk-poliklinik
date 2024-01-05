<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Faker\Factory;

use App\Helpers\FormatterCustom;

use App\Models\CheckupSchedule;
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
            'name' => 'Dokter Bambang',
            'address' => $faker->address(),
            'phone_number' => $phoneNumber,
        ]);

        $day = date('l');
        $day = FormatterCustom::changeDayIndo($day);

        CheckupSchedule::create([
            'doctor_id' => $doctor->id,
            'poli_id' => $doctor->poli_id,
            'day' => $day,
            'start_time' => '01:00:00',
            'end_time' => '23:59:00',
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

        $poli = Poli::orderBy('id', 'desc')->first();

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'poli_id' => $poli->id,
            'name' => 'Dokter Mamat',
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
