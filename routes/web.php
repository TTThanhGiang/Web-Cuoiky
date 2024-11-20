<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
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


Route::get('send',[HomeController::class, 'sendEmail']);