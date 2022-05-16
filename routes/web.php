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

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

    Route::post('/addcart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

    Route::post('/clearcart', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/deletecartitem', [\App\Http\Controllers\CartController::class, 'deleteItem'])->name('cart.deleteItem');

    Route::post('/gotopay', [\App\Http\Controllers\CartController::class, 'goToPay'])->name('cart.goToPay');

    Route::get('orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');

    Route::post('orders/{order}/refresh', [\App\Http\Controllers\OrderController::class, 'refresh'])->name('orders.refresh');

    Route::post('orders/{order}/retry', [\App\Http\Controllers\OrderController::class, 'retry'])->name('orders.retry');

    Route::get('orders/{order}/refreshAfterCheckout', [\App\Http\Controllers\OrderController::class, 'refreshAfterCheckout'])->name('orders.refreshAfterCheckout');;


});


/*
        Admin Routes
 */
    Route::middleware( ['admin.only', 'auth', 'verified'])->group(function () {

        Route::get('viewReport/{path}', [\App\Http\Controllers\ReportController::class, 'viewReport'])->name('viewReport');

        Route::post('/piechart', [\App\Http\Controllers\ReportController::class, 'create'])->name('createChart');

        Route::get('piechart', [\App\Http\Controllers\ReportController::class, 'piechart'])->name('piechart');

        Route::get('reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');

        Route::post('reports/totalSalesByCtgry', [\App\Http\Controllers\ReportController::class, 'totalSalesByCtgry'])->name('totalSalesByCtgry');

        Route::post('reports/salesStatus', [\App\Http\Controllers\ReportController::class, 'salesStatus'])->name('salesStatus');

        Route::get('downloadExport/{path}/dld', [\App\Http\Controllers\ProductController::class, 'downloadExport'])->name('downloadExport');

        Route::get('downloadExport/{path}', [\App\Http\Controllers\ProductController::class, 'downloadExportView'])->name('downloadExportView');

        Route::resource('users', \App\Http\Controllers\UserController::class);

        Route::get('products.exportView', [\App\Http\Controllers\ProductController::class, 'exportView'])->name('products.exportView');

        Route::post('products.export', [\App\Http\Controllers\ProductController::class, 'export'])->name('products.export');

        Route::post('products.import', [\App\Http\Controllers\ProductController::class, 'import'])->name('products.import');

        Route::get('products.importForm', [\App\Http\Controllers\ProductController::class, 'importForm'])->name('products.importForm');

        Route::get('products.create2', [\App\Http\Controllers\ProductController::class, 'create2'])->name('products.create2');

        Route::resource('products', \App\Http\Controllers\ProductController::class)->except('index','show');

        Route::post('images/{id}', [\App\Http\Controllers\ImageController::class, 'storeImages'])->name('store.images');

        Route::post('images/{id}/newImg', [\App\Http\Controllers\ImageController::class, 'storeNewImages'])->name('store.new.images');

        Route::get('images/{product}/edit', [\App\Http\Controllers\ImageController::class, 'editImage'])->name('edit.images');

        Route::resource('images', \App\Http\Controllers\ImageController::class);
    }
);
