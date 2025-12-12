<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard (after login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔹 Activity Tracker routes (YOUR APP)
    Route::get('/activities/create', [ActivityController::class, 'create']);
    Route::post('/activities', [ActivityController::class, 'store']);

    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit']);
    Route::put('/activities/{activity}', [ActivityController::class, 'update']);

    Route::get('/activities/daily-updates', [ActivityController::class, 'dailyUpdates']);
    Route::get('/activities/reports', [ActivityController::class, 'reports']);
});

require __DIR__.'/auth.php';
