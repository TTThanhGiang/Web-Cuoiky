<?php

use App\Http\Controllers\UserController;
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
    return view(view: 'web/index');
});
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
Route::get('/category', function () {
    return view('web/category');
});

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

// routes/web.php

Route::get('admin/User/index', [UserController::class, 'index'])->name('admin.User.index');
Route::get('admin/User/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
Route::post('admin/User/{id}/update', [UserController::class, 'update'])->name('admin.User.update');
Route::delete('admin/User/{id}', [UserController::class, 'delete'])->name('admin.User.delete');

Route::get('admin/User/create', [UserController::class, 'create'])->name('admin.User.create');
Route::post('admin/User', [UserController::class, 'store'])->name('admin.User.store');
