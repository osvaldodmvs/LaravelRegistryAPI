<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users_index')->middleware('auth');
Route::get('/users/search', [UserController::class, 'search'])->name('users_search')->middleware('auth');
Route::get('/users/filter/{Profession}', [UserController::class, 'filter'])->name('users_filter')->middleware('auth');

Route::middleware(['is_admin'])->group(function () {
    Route::post('/users', [UserController::class, 'store'])->name('users_index_store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users_create');
    Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users_show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users_edit');
    Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users_update');
    Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users_destroy');
    Route::get('/users/export', [UserController::class, 'export'])->name('users_export');
});
