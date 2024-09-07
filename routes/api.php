<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::resource('/lecturers', LectureController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/schedules', ScheduleController::class);
});
