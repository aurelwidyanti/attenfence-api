<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'course_id' => 1,
                'day' => 'Monday',
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room' => 'A101',
            ],
            [
                'course_id' => 2,
                'day' => 'Tuesday',
                'start_time' => '10:00',
                'end_time' => '12:00',
                'room' => 'A102',
            ],
            [
                'course_id' => 3,
                'day' => 'Wednesday',
                'start_time' => '13:00',
                'end_time' => '15:00',
                'room' => 'A103',
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
