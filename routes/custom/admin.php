<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\PositionController;
 
Route::group(['middleware' => ['auth:staff']],function(){
    Route::group(['middleware' => ['cek_login:1']],function(){

        Route::controller(DashboardController::class)->group(function(){
            Route::get('/', 'index')->name('admin.dashboard');
        });

        Route::controller(DepartementController::class)->group(function(){
            Route::get('/departement', 'index')->name('admin.departement');
            Route::get('/departement/create', 'create')->name('admin.departement.create');
            Route::get('/departement/edit/{id}', 'edit')->name('admin.departement.edit');
            Route::post('/departement/store', 'store')->name('admin.departement.store');
            Route::post('/departement/update/{id}', 'update')->name('admin.departement.update');
            Route::get('/departement/delete/{id}', 'destroy')->name('admin.departement.delete');
        });

        Route::controller(PositionController::class)->group(function(){
            Route::get('/position/{slug}', 'index')->name('admin.position');
            Route::get('/position/{slug}/create', 'create')->name('admin.position.create');
            Route::get('/position/{slug}/edit/{id}', 'edit')->name('admin.position.edit');
            Route::post('/position/{slug}/store', 'store')->name('admin.position.store');
            Route::post('/position/update/{id}', 'update')->name('admin.position.update');
            Route::get('/position/delete/{id}', 'destroy')->name('admin.position.delete');
        });
    });
});