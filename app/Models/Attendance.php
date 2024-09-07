<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'course_id', 
        'date', 
        'time', 
        'status',
    ];

    // Relasi dengan Student
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
