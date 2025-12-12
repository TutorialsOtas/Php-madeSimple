<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ActivityController;

Route::get('/activities/create', [ActivityController::class, 'create']);
Route::post('/activities', [ActivityController::class, 'store']);
Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit']);
Route::put('/activities/{activity}', [ActivityController::class, 'update']);

