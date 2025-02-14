<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Registered User',
            'email' => 'registered@example.com',
            'password' => Hash::make('password'),
            'role' => 'registered',
        ]);

        User::create([
            'name' => 'Visitor User',
            'email' => 'visitor@example.com',
            'password' => Hash::make('password'),
            'role' => 'visitor',
        ]);
    }
}
