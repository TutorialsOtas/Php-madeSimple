<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Root always goes to signup
Route::get('/', fn () => redirect('/signup'));

// Sign up (custom)
Route::get('/signup', [SignupController::class, 'show'])->name('signup.show');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

// Breeze auth routes (login, logout, password reset, etc.)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Dashboard (after login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated application routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Activity Tracker
    Route::get('/activities/create', [ActivityController::class, 'create']);
    Route::post('/activities', [ActivityController::class, 'store']);

    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit']);
    Route::put('/activities/{activity}', [ActivityController::class, 'update']);

    Route::get('/activities/daily-updates', [ActivityController::class, 'dailyUpdates']);
    Route::get('/activities/reports', [ActivityController::class, 'reports']);
});
