<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/home', function () {
    return view('home');
// Suggested code may be subject to a license. Learn more: ~LicenseLog:88410626.
});

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::get('/login',[LoginController::class, 'login'])->name('auth.login');
Route::post('/login',[LoginController::class, 'processLogin'])->name('auth.process.login');
Route::get('/register',[RegisterController::class, 'register'])->name('auth.register');
Route::post('/register',[RegisterController::class, 'processRegister'])->name('auth.process.register');
Route::get('/logout',[LoginController::class, 'logout'])->name('auth.logout');
Route::get('/reset/password/',[ResetPasswordController::class, 'index'])->name('auth.reset');
Route::post('/reset/password/',[ResetPasswordController::class, 'store'])->name('auth.reset.store');
Route::get('/reset/password/{token}',[ResetPasswordController::class, 'resetPassword'])->name('auth.reset.password');
Route::post('/reset/password/{token}',[ResetPasswordController::class, 'processResetPassword'])->name('auth.process.reset.password');