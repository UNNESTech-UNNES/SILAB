<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipeKepemilikan;

class TipeKepemilikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = ['SPARKA', 'MEDUNES', 'MELODY', 'SILAB', 'SENTIS', 'FACETRO'];

        foreach ($types as $type) {
            TipeKepemilikan::create(['nama' => $type]);
        }
    }
}
