<?php

use App\Http\Controllers\Applicant\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:4']],function(){
        
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/profile', 'index')->name('applicant.profile');
            Route::post('/profile/edit', 'updateInfo')->name('applicant.profile.info');
        });
    });
});