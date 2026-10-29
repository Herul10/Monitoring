<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // GURU
        User::create([
            'name' => 'Bapak Guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);

        // SISWA
        User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);
    }
}