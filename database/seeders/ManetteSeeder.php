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
            $serialNumber = 'CTL-' . strtoupper(Str::random(8));
            Manette::firstOrCreate(
                ['serial_number' => $serialNumber],
                [
                    'serial_number' => $serialNumber,
                    'status' => 'available'
                ]
            );
        }
    }
}
