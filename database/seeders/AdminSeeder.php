<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
                'role' => 'client'
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@user.com',
            'password' => Hash::make('user123'),
            'role' => 'client'
        ]);
    }
}
