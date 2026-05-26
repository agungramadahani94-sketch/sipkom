<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'no_tlp' => '08123456789',
            'role' => 'user',
            'password' => Hash::make('123456'),
        ]);



        User::create([
            'nama' => 'Agung Ramadhan Pratama Putra',
            'email' => 'agung@gmail.com',
            'no_tlp' => '08123456789',
            'role' => 'user',
            'password' => Hash::make('123456'),
        ]);

    }

     
}
