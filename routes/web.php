<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::get('products/cleaning', [\App\Http\Controllers\ProductController::class, 'cleaning'])->name('products.cleaning');

Route::get('products/health', [\App\Http\Controllers\ProductController::class, 'health'])->name('products.health');

Route::get('products/food', [\App\Http\Controllers\ProductController::class, 'food'])->name('products.food');

Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show')->middleware('checkProductIsActive:product');

Route::post('products/search', [\App\Http\Controllers\ProductController::class, 'search'])->name('products.search');



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

    Route::get('products.create2', [\App\Http\Controllers\ProductController::class, 'create2'])->name('products.create2');

    Route::resource('products', \App\Http\Controllers\ProductController::class)->except('index','show');

    Route::get('images/{product}/edit', [\App\Http\Controllers\ImageController::class, 'editImage'])->name('edit.images');

    Route::post('images/{id}', [\App\Http\Controllers\ImageController::class, 'storeImages'])->name('store.images');

    Route::post('images/{id}', [\App\Http\Controllers\ImageController::class, 'storeNewImages'])->name('store.new.images');

    Route::resource('images', \App\Http\Controllers\ImageController::class);

});
