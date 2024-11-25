<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Amin\CategoryController;
use App\Http\Controllers\Amin\ProductController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PaymentController;
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
Route::get('/blogs', [HomeController::class, 'viewBlogs'])->name('blogs.view');
Route::get('/blogs/{id}', [HomeController::class, 'viewBlogDetail'])->name('blogs.viewBlogDetail');


Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', [CartController::class, 'viewCart'])->name('view');      
    Route::post('/', [CartController::class, 'addToCart'])->name('add');    
    Route::post('/update', [CartController::class, 'update'])->name('update'); 
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
});


Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
    Route::get('/', [CheckoutController::class,'index'])->name('index');
    Route::post('/', [CheckoutController::class,'order'])->name('order');
    Route::get('/payment', [CheckoutController::class,'paymentView'])->name('paymentView');
    Route::post('/vnpay_payment', [PaymentController::class,'vnpay_payment'])->name('vnpay_payment');
    Route::get('/vnpay_return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::post('/cash_payment', [PaymentController::class,'cash_payment'])->name('cash_payment');
});



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

    Route::get('/orders', [AuthController::class, 'orders'])->name('orders');

});

Route::group(['prefix' => 'admin/blogs', 'as' => 'admin.blogs.'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index'); 
    Route::get('/create', [BlogController::class, 'create'])->name('create'); 
    Route::post('/create', [BlogController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit'); 
    Route::post('/edit/{id}', [BlogController::class, 'update'])->name('update');
});


Route::get('admin/index', [UserController::class, 'index'])->name('admin.User.index');
Route::get('admin/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
Route::post('admin/{id}/update', [UserController::class, 'update'])->name('admin.User.update');
Route::delete('admin/{id}', [UserController::class, 'delete'])->name('admin.User.delete');

Route::get('admin/create', [UserController::class, 'create'])->name('admin.User.create');
Route::post('admin/user', [UserController::class, 'store'])->name('admin.User.store');



