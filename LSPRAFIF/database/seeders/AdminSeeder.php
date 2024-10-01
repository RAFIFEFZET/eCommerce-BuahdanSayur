<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin-Rafif',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'Admin',
        ]);

        User::create([
            'name' => 'Manager-Fawwaz',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'Manager',
        ]);
    }
}