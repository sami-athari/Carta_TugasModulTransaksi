<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan user admin dan user biasa
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123123'),
            'type' => 1, // admin
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('123123'),
            'type' => 0, // regular user
        ]);

        User::create([
            'name' => 'Sami',
            'email' => 'sami@mail.com',
            'password' => bcrypt('123123'),
            'type' => 0, // regular user
        ]);
    }
}
