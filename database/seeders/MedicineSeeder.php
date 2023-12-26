<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicine::create([
            'name' => 'Hufagrip',
            'packaging' => 'Tablet',
            'price' => 20000,
        ]);
    }
}
