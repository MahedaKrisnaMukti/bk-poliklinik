<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Faker\Factory;

use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
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
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $user->assignRole('Admin');

        $phoneNumber = $faker->e164PhoneNumber();
        $phoneNumber = str_replace('+', '', $phoneNumber);
        $phoneNumber = '8' . $phoneNumber;

        Admin::create([
            'user_id' => $user->id,
            'name' => 'Admin',
            'phone_number' => $phoneNumber,
        ]);
    }
}
