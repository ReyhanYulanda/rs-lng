<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'karyawan',
            'email' => 'karyawan@karyawan.com',
            'role' => 'karyawan',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'tenaga medis',
            'email' => 'tenagamedis@tenagamedis.com',
            'role' => 'tenaga_medis',
            'password' => Hash::make('12345678'),
        ]);
    }
}
