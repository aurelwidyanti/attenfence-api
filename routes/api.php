<?php

use App\Http\Controllers\AttendanceController;
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
    Route::resource('/lectures', LectureController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/schedules', ScheduleController::class);
    Route::resource('/attendances', AttendanceController::class);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
