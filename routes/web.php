<?php

use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * ------------------------------------------------------------------------------------------------------------
 * Student Route Start
 * ------------------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
});
/**
 * -----------------------------------------------------------------------------------------------------------
 * Student Route Start
 * ------------------------------------------------------------------------------------------------------------
 */

 /**
  * -----------------------------------------------------------------------------------------------------------
 * Instructor Route Start
 * ------------------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});
 /**
  * ----------------------------------------------------------------------------------------------------------
 * Instructor Route End
 * -----------------------------------------------------------------------------------------------------------
 */

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
