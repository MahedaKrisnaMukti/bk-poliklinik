<?php

namespace Database\Seeders;

use App\Helpers\FormatterCustom;
use App\Models\CheckupSchedule;
use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Models\Patient;
use App\Models\PoliRegister;

class PoliRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $patient = Patient::first();

        $day = date('l');
        $day = FormatterCustom::changeDayIndo($day);

        $today = date('Y-m-d');

        $checkupSchedule = CheckupSchedule::firstWhere('day', $day);

        PoliRegister::create([
            'patient_id' => $patient->id,
            'checkup_schedule_id' => $checkupSchedule->id,
            'poli_register_date' => $today,
            'complaint' => 'Pusing mikirin skripsi',
        ]);

        $patient = Patient::orderBy('id', 'desc')->first();

        PoliRegister::create([
            'patient_id' => $patient->id,
            'checkup_schedule_id' => $checkupSchedule->id,
            'poli_register_date' => $today,
            'complaint' => 'Pusing mikirin pacar',
        ]);
    }
}
