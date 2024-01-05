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

        Poli::create([
            'name' => 'Poli Gigi',
            'description' => 'Poli Gigi',
        ]);

        Poli::create([
            'name' => 'Poli Gizi',
            'description' => 'Poli Gizi',
        ]);

        Poli::create([
            'name' => 'Poli Mata',
            'description' => 'Poli Mata',
        ]);
    }
}
