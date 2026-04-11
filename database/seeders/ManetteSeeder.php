<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manette;
use Illuminate\Support\Str;

class ManetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Manette::create([
                'serial_number' => 'CTL-' . strtoupper(Str::random(8)),
                'status' => 'available'
            ]);
        }
    }
}
