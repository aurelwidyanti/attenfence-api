<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nim' => 'A11.2022.14494',
            'name' => 'Aurel Putri Widyanti',
            'email' => 'aurelwyt@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
