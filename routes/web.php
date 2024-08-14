<?php

use App\Http\Controllers\Auth\LoginController;
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

Route::get('/login',[LoginController::class, 'login'])->name('auth.login');
Route::post('/login',[LoginController::class, 'processLogin'])->name('auth.process.login');
Route::get('/register',[LoginController::class, 'register'])->name('auth.register');
Route::post('/register',[LoginController::class, 'processRegister'])->name('auth.process.register');