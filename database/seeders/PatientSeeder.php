<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Faker\Factory;

use App\Models\Patient;
use App\Models\User;

class PatientSeeder extends Seeder
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
            'email' => 'patient@gmail.com',
            'password' => Hash::make('patient'),
        ]);

        $user->assignRole('Pasien');

        $phoneNumber = $faker->e164PhoneNumber();
        $phoneNumber = str_replace('+', '', $phoneNumber);
        $phoneNumber = '8' . $phoneNumber;

        $identityCardNumber = $faker->randomNumber(8, true) . $faker->randomNumber(8, true);

        Patient::create([
            'user_id' => $user->id,
            'name' => 'Reyhan',
            'address' => $faker->address(),
            'identity_card_number' => $identityCardNumber,
            'phone_number' => $phoneNumber,
        ]);
    }
}
