<?php

namespace Database\Seeders;

use App\Models\Console;
use Illuminate\Database\Seeder;

class ConsoleSeeder extends Seeder
{
    public function run(): void
    {
        $consoles = [
            ['name' => 'PlayStation 5', 'brand' => 'Sony', 'daily_price' => 25.00, 'ability' => true],
            ['name' => 'Xbox Series X', 'brand' => 'Microsoft', 'daily_price' => 23.00, 'ability' => true],
            ['name' => 'Nintendo Switch', 'brand' => 'Nintendo', 'daily_price' => 15.00, 'ability' => true],
            ['name' => 'PlayStation 4', 'brand' => 'Sony', 'daily_price' => 18.00, 'ability' => true],
            ['name' => 'Xbox One', 'brand' => 'Microsoft', 'daily_price' => 16.00, 'ability' => false],
        ];

        foreach ($consoles as $console) {
            Console::create($console);
        }
    }
}
