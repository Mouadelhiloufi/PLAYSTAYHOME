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
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('user123'),
                'role' => 'client'
            ]
        );

        User::firstOrCreate(
            ['email' => 'jane@user.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('user123'),
                'role' => 'client'
            ]
        );
    }
}
