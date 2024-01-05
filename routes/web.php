<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/detail', function () {
    return view('productDetails');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin
    Route::get('/admin/dashboard', [ProductController::class, 'index'] )->name('dashboard');

    // product
    Route::post('/products/create', [ProductController::class, 'create']);
    Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');


});

require __DIR__.'/auth.php';
