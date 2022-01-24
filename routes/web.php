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

/*
        Guest Routes
 */
Auth::routes(['verify' => true]);

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');



/*
        User Routes
 */

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


/*
        Admin Routes
 */
Route::middleware( ['admin.only', 'auth', 'verified'])->group(function () {

    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::patch('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');

//    Route::resource('products', \App\Http\Controllers\UserController::class);

    Route::get('products/create', [\App\Http\Controllers\ProductController::class, 'create']);

    Route::post('products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');

    Route::get('products/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit']);

    Route::delete('products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy']);

    Route::patch('products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');

});
