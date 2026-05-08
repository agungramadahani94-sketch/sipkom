<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Agung Ramadhan',
            'email' => 'agung@gmail.com',
            'no_tlp' => '08123456789',
            'role' => 'admin',
            'password' => Hash::make('123123123'),
        ]);

        User::create([
            'nama' => 'Naqa Nayaka',
            'email' => 'naka@gmail.com',
            'no_tlp' => '08123456780',
            'role' => 'user',
            'password' => Hash::make('123123123'),
        ]);

        User::create([
            'nama' => 'Syarif Aditya',
            'email' => 'syarif@gmail.com',
            'no_tlp' => '08123456781',
            'role' => 'user',
            'password' => Hash::make('123123123'),
        ]);
    }
}