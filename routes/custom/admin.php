<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\QuestionController;

Route::group(['middleware' => ['auth:staff']],function(){
    Route::group(['middleware' => ['cek_login:1']],function(){

        Route::controller(DashboardController::class)->group(function(){
            Route::get('/', 'index')->name('admin.dashboard');
        });

        //Departement Controller - Mengatur Departement Controller
        Route::controller(DepartementController::class)->group(function(){
            Route::get('/departement', 'index')->name('admin.departement'); //Menampilkan Index
            Route::get('/departement/create', 'create')->name('admin.departement.create'); //Menampilkan halaman create
            Route::get('/departement/edit/{id}', 'edit')->name('admin.departement.edit'); //Menampilkan halaman edit
            Route::post('/departement/store', 'store')->name('admin.departement.store'); //Menambahkan data
            Route::post('/departement/update/{id}', 'update')->name('admin.departement.update'); //Mengupdate data
            Route::get('/departement/delete/{id}', 'destroy')->name('admin.departement.delete'); //Menghapus data
        });

        //Position Controller - Mengatur Position Controller
        Route::controller(PositionController::class)->group(function(){
            Route::get('/position/{slug}', 'index')->name('admin.position'); //Menampilkan Index
            Route::get('/position/{slug}/create', 'create')->name('admin.position.create'); //Menampilkan halaman create
            Route::get('/position/{slug}/edit/{id}', 'edit')->name('admin.position.edit'); //Menampilkan halaman edit
            Route::post('/position/{slug}/store', 'store')->name('admin.position.store'); //Menambahkan data
            Route::post('/position/update/{id}', 'update')->name('admin.position.update'); //Mengupdate data
            Route::get('/position/delete/{id}', 'destroy')->name('admin.position.delete'); //Menghapus data

        });

        //Question Controller - Mengatur Question Controller
        Route::controller(QuestionController::class)->group(function(){
            Route::get('/question', 'index')->name('admin.question'); //Menampilkan Index
            Route::get('/question/create', 'create')->name('admin.question.create'); //Menampilkan halaman create
            Route::get('/question/edit/{id}', 'edit')->name('admin.question.edit'); //Menampilkan halaman edit
            Route::post('/question/store', 'store')->name('admin.question.store'); //Menambahkan data
            Route::post('/question/update/{id}', 'updateQuestion')->name('admin.question.update'); //Mengupdate data
            Route::get('/question/delete/{id}', 'destroy')->name('admin.question.delete'); //Menghapus data
            Route::get('/question/show/{id}','show')->name('admin.question.show'); //Menampilkan halaman show
            Route::post('/question/{id}/answer', 'storeAnswer')->name('admin.choice.store'); //Store data answer

            Route::get('/question/answer/delete/{id}', 'deleteAnswer')->name('admin.choice.delete');

        });
    });
});