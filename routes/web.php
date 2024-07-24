<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\UserController;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class)->except('show');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['role:student']], function () {
    Route::get('profile', [StudentProfileController::class, 'show'])->name('student.profile');
});

Auth::routes(['register' => false]);
