<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;  // ← import your controller
use App\Http\Controllers\MeetingRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule', [ScheduleController::class, 'index'])
     ->name('schedule.index');

Route::post('/schedule/optimize', [ScheduleController::class, 'optimize'])
     ->name('schedule.optimize');

Route::resource('meetings', MeetingRequestController::class)
     ->only(['create','store','destroy']);

