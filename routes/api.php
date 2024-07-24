<?php

use App\Http\Controllers\Api\UserCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('course-data', [UserCourseController::class, 'getCourseData'])->name('course-data');
Route::get('mentor-data', [UserCourseController::class, 'getMentorData'])->name('mentor-data');
Route::get('sarjana-data', [UserCourseController::class, 'getDataSarjana'])->name('sarjana-data');
Route::get('magister-data', [UserCourseController::class, 'getDataMagister'])->name('magister-data');
