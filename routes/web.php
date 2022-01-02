<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');

//Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy']);

Route::resource('/users', \App\Http\Controllers\UserController::class);

Route::patch('/users/{user}/ban', [\App\Http\Controllers\UserController::class, 'ban'])->name('users.ban');

Route::patch('/users/{user}/unban', [\App\Http\Controllers\UserController::class, 'unban'])->name('users.unban');

Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
