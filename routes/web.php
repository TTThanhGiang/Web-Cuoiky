<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Role;
use App\Http\Controllers\UserController;
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

Route::get('/categories', [CategoryController::class, 'index'])->name('web/category');
Route::get('/categories/products/{id}', [ProductController::class, 'show'])->name('web/detail');

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

Route::get('admin/User/index', [UserController::class, 'index'])->name('admin.User.index');
Route::get('admin/User/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
Route::post('admin/User/{id}/update', [UserController::class, 'update'])->name('admin.User.update');
Route::delete('admin/User/{id}', [UserController::class, 'delete'])->name('admin.User.delete');

Route::get('admin/User/create', [UserController::class, 'create'])->name('admin.User.create');
Route::post('admin/User', [UserController::class, 'store'])->name('admin.User.store');

