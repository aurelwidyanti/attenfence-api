<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attendances = [
            [
                'user_id' => 1,
                'schedule_id' => 1,
                'date' => '2024-09-06',
                'time' => '08:00',
                'status' => 'Present',
            ],
            [
                'user_id' => 1,
                'schedule_id' => 2,
                'date' => '2024-09-07',
                'time' => '10:00',
                'status' => 'Absent',
            ],
            [
                'user_id' => 1,
                'schedule_id' => 3,
                'date' => '2024-09-08',
                'time' => '13:00',
                'status' => 'Late',
            ],
        ];

        foreach ($attendances as $attendance) {
            Attendance::create($attendance);
        }
    }
}
