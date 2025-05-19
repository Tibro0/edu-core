<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

/**
 * ------------------------------------------------------------------------------------------------------------
 * Frontend Route Start
 * ------------------------------------------------------------------------------------------------------------
 */
Route::get('/', [FrontendController::class, 'index'])->name('home');
 /**
 * ------------------------------------------------------------------------------------------------------------
 * Frontend Route End
 * ------------------------------------------------------------------------------------------------------------
 */


/**
 * ------------------------------------------------------------------------------------------------------------
 * Student Route Start
 * ------------------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');

    Route::put('become-instructor', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become-instructor.update');
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
    Route::get('dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});
 /**
  * ----------------------------------------------------------------------------------------------------------
 * Instructor Route End
 * -----------------------------------------------------------------------------------------------------------
 */

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
