<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 
        'lecture_id',
        'name', 
        'sks',
    ];

    // Relasi dengan lecture
    public function lecture()
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
