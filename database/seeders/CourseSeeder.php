<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'code' => 'IF4202',
                'lecture_id' => 1,
                'name' => 'Pemrograman Berbasis Objek',
                'sks' => 3,
            ],
            [
                'code' => 'IF4203',
                'lecture_id' => 2,
                'name' => 'Pemrograman Web',
                'sks' => 3,
            ],
            [
                'code' => 'IF4204',
                'lecture_id' => 1,
                'name' => 'Pemrograman Mobile',
                'sks' => 4,
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
