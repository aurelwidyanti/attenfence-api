<?php

namespace Database\Seeders;

use App\Models\Lecture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lectures = [
            [
                'nidn' => '001',
                'name' => 'John Doe',
                'email' => 'lecture1@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => '002',
                'name' => 'Jane Doe',
                'email' => 'lecture2@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($lectures as $lecture) {
            Lecture::create($lecture);
        }
    }
}
