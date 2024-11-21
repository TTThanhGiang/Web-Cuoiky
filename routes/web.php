<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [ProductController::class, 'getProducts'])->name('web/index');

Route::get('/detail', function () {
    return view('web/detail');
});
Route::get('/cart', function () {
    return view('web/cart');
});
Route::get('/login', function () {
    return view('web/login');
});
Route::get('/registration', function () {
    return view('web/registration');
});
Route::get('/checkout', function () {
    return view('web/checkout');
});
Route::get('/categories', [CategoryController::class, 'index'])->name('web/category');
Route::get('/categories/products/{id}', [ProductController::class, 'show'])->name('web/detail');

Route::get('admin', function () {
    return view('admin/index');
});

Route::get('admin/products', function () {
    return view('admin/product/index');
});

Route::get('admin/products/create', function () {
    return view('admin/product/create');
});

Route::get('admin/products/edit', function () {
    return view('admin/product/edit');
});


