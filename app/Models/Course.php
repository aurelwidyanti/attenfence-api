<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 
        'lecturer_id',
        'name', 
        'sks',
    ];

    // Relasi dengan Lecturer
    public function lecturer()
    {
        return $this->belongsTo(Lecture::class);
    }

    // Relasi dengan Schedules dan Attendance tetap sama
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
