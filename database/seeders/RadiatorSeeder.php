<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Radiator;
use Illuminate\Database\Seeder;

class RadiatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Radiator::query()->create([
            'name' => 'Stelrad Softline Compact',
            'description' => 'The Softline is one of the most popular radiator ranges in the UK. Beautifully curved with top grille and end panels, the Stelrad Softline radiator is expertly designed for all of your home’s needs. Professionally fit and secure - this top of the range radiator will provide you with optimum comfort.',
        ]);
    }
}
