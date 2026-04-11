<?php

namespace Database\Seeders;

use App\Models\Console;
use Illuminate\Database\Seeder;

class ConsoleSeeder extends Seeder
{
    public function run(): void
    {
        $consoles = [
            ['name' => 'PlayStation 5', 'brand' => 'Sony', 'daily_price' => 100.00, 'ability' => true, 'image' => 'https://tse3.mm.bing.net/th/id/OIP.HDwUl48c-SLF9N80wk-JbgHaHa?w=1214&h=1214&rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['name' => 'Xbox Series X', 'brand' => 'Microsoft', 'daily_price' => 100.00, 'ability' => true, 'image' => 'https://tse2.mm.bing.net/th/id/OIP.xdDxVtikwxvByq9WtwqlGwHaE8?rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['name' => 'Nintendo Switch', 'brand' => 'Nintendo', 'daily_price' => 70.00, 'ability' => true, 'image' => 'https://tse1.mm.bing.net/th/id/OIP.auQcMgyi_LMo6xiBYdoyXAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['name' => 'PlayStation 4', 'brand' => 'Sony', 'daily_price' => 50.00, 'ability' => true, 'image' => 'https://th.bing.com/th/id/OIP.wtPviDCztazye13m89k0VAHaEK?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['name' => 'Xbox One', 'brand' => 'Microsoft', 'daily_price' => 40.00, 'ability' => false, 'image' => 'https://tse1.mm.bing.net/th/id/OIP.auQcMgyi_LMo6xiBYdoyXAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3'],
            
        ];

        foreach ($consoles as $console) {
            Console::create($console);
        }
    }
}
