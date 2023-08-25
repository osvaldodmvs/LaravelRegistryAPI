<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\Auth\LoginApiController;
use App\Http\Controllers\Auth\RegisterApiController;



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

Route::post('/login', [LoginApiController::class, 'login']);
Route::post('/register', [RegisterApiController::class, 'register']);

Route::middleware(['is_api_logged'])->group(function () {
    Route::post('/logout', [LoginApiController::class, 'logout']);
    Route::get('/users', [UserApiController::class, 'index']);
    Route::post('/users', [UserApiController::class, 'store'])->middleware('api_is_admin');
    Route::get('/users/{user}', [UserApiController::class, 'show'])->middleware('api_is_admin');
    Route::put('/users/{user}', [UserApiController::class, 'update'])->middleware('api_is_admin');
    Route::delete('/users/{user}', [UserApiController::class, 'destroy'])->middleware('api_is_admin');
});