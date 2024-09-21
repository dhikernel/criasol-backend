<?php

use App\Domain\Scheduling\Controllers\SchedulingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {

    Route::get('/user', [LoginController::class, 'user'])->middleware('auth:sanctum');

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('/register', [RegisterController::class, 'register']);
});

Route::get('/', function () {
    return response()->json(['message' => 'Criasol Backend API', 'status' => 'Connected']);
});

Route::fallback(function () {
    return response()->json(['message' => 'Route not found', 'status' => 'Connected']);
});

Route::prefix('scheduling')->group(function () {

    Route::get('/list', [SchedulingController::class, 'index'])->middleware('auth:sanctum');

    Route::post('/create', [SchedulingController::class, 'store'])->middleware('auth:sanctum');

    Route::put('/update/{id}', [SchedulingController::class, 'update'])->middleware('auth:sanctum');

    Route::delete('/delete/{id}', [SchedulingController::class, 'destroy'])->middleware('auth:sanctum');
});
