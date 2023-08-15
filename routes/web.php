<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('data_times', App\Http\Controllers\Admin\TimeScheduleController::class);
        Route::resource('data_days', App\Http\Controllers\Admin\DayScheduleController::class);
        Route::resource('data_rooms', App\Http\Controllers\Admin\RoomController::class);
        Route::resource('data_classrooms', App\Http\Controllers\Admin\ClassroomController::class);
        Route::resource('data_courses', App\Http\Controllers\Admin\CourseController::class);
        Route::resource('data_teachers', App\Http\Controllers\Admin\TeacherController::class);
        Route::resource('data_schedules', App\Http\Controllers\Admin\CourseScheduleController::class)->only(['index','store']);
    });

    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('data_schedules', App\Http\Controllers\Teacher\CourseScheduleController::class);
    });
});

require __DIR__.'/auth.php';
