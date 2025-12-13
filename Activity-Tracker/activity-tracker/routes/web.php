<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;

// Always show signup first (simple + no surprises)
Route::get('/', fn () => redirect()->route('signup.show'));

// Signup
Route::get('/signup', [SignupController::class, 'show'])->name('signup.show');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

// Dashboard (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// App routes (protected)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activities/create', [ActivityController::class, 'create']);
    Route::post('/activities', [ActivityController::class, 'store']);

    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit']);
    Route::put('/activities/{activity}', [ActivityController::class, 'update']);

    Route::get('/activities/daily-updates', [ActivityController::class, 'dailyUpdates']);
    Route::get('/activities/reports', [ActivityController::class, 'reports']);
});

// Keep Breeze auth routes (mainly for logout)
require __DIR__.'/auth.php';
