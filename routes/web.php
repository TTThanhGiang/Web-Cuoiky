<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Amin\CategoryController;
use App\Http\Controllers\Amin\ProductController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Order;
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

Route::get('/categories', [CategoryController::class, 'detail'])->name('home.category');
Route::get('/categories/products/{id}', [HomeController::class, 'show'])->name('home.detail');

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


Route::group(['prefix' => 'admin'], function () {
    // Show all users
    Route::get('/user/index', [UserController::class, 'index'])->name('admin.User.index');
    
    // Create a new user
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.User.create');
    Route::post('/user/user', [UserController::class, 'store'])->name('admin.User.store');
    
    // Edit an existing user
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('admin.User.update');
    //search
    Route::get('/user/search', [UserController::class, 'search'])->name('admin.User.search');
    // Delete a user
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('admin.User.delete');
    // show all order
    Route::get('/order/index', [OrderController::class, 'index'])->name('admin.order.index');
    // show view order
    Route::get('/order/{id}/show', [OrderController::class, 'show'])->name('admin.order.show');
    // form edit
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');

    // Route update
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('admin.order.update');
    //search
    Route::get('/order/search', [OrderController::class, 'search'])->name('admin.order.search');


});


