<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\OrderController;
use App\Models\Order;
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
    Route::post('/order-details', [AuthController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/order-details/{orderId}', [AuthController::class, 'viewOrder'])->name('orderDetails');


});

Route::group(['prefix' => 'admin/blogs', 'as' => 'admin.blogs.'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/create', [BlogController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [BlogController::class, 'update'])->name('update');
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



Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.category.index');

Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('admin/categories/store', [CategoryController::class, 'store'])->name('admin.category.store');

Route::get('admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::post('admin/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');

Route::delete('admin/categories/{id}/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');

Route::get('admin/products', [ProductController::class, 'index'])->name('admin.product.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('admin/products/store', [ProductController::class, 'store'])->name('admin.product.store');

Route::get('admin/products/update', [ProductController::class, 'update'])->name('admin.product.update');
Route::get('admin/products/delete', [ProductController::class, 'delete'])->name('admin.product.delete');




