<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Amin\CategoryController;
use App\Http\Controllers\Amin\ProductController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Models\Role;
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



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/details/{id}',[HomeController::class, 'detail'])->name('home.detail');
Route::get('/category/{id?}',[HomeController::class, 'category'])->name('category.products');


Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


Route::group(['prefix'=> 'account'], function(){
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::get('/verify-account/{email}', [AuthController::class, 'verify'])->name('verify');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'checkProfile']);

    Route::get('/reset-password', [AuthController::class, 'formResetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::get('/forgot-password', [AuthController::class, 'formForgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

});


Route::get('admin/index', [UserController::class, 'index'])->name('admin.User.index');
Route::get('admin/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
Route::post('admin/{id}/update', [UserController::class, 'update'])->name('admin.User.update');
Route::delete('admin/{id}', [UserController::class, 'delete'])->name('admin.User.delete');

Route::get('admin/create', [UserController::class, 'create'])->name('admin.User.create');
Route::post('admin/user', [UserController::class, 'store'])->name('admin.User.store');

