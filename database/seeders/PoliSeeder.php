<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poli::create([
            'name' => 'Poli THT',
            'description' => 'Poli THT',
        ]);
    }
}
