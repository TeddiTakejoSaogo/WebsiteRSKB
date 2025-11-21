<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah user admin sudah ada
        $adminExists = User::where('email', 'admin@rumahsakit.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@rumahsakit.com',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }

        // Cek apakah user biasa sudah ada
        $userExists = User::where('email', 'user@example.com')->exists();
        
        if (!$userExists) {
            User::create([
                'name' => 'User Biasa',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user'
            ]);
            $this->command->info('Regular user created successfully.');
        } else {
            $this->command->info('Regular user already exists.');
        }
    }
}