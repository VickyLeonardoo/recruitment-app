<?php

use App\Http\Controllers\Applicant\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:4']],function(){
        
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/profile', 'index')->name('applicant.profile.info');
            Route::post('/profile/edit', 'updateInfo')->name('applicant.profile.info.update');
            

            //Education
            Route::get('/profile/education','education')->name('applicant.profile.education');
            Route::post('/profile/education/store', 'storeEducation')->name('applicant.profile.education.store');
            Route::post('/profile/education/update/{id}', 'updateEducation')->name('applicant.profile.education.update');
            Route::get('/profile/education/delete/{id}', 'deleteEducation')->name('applicant.profile.education.delete');

            //Experience
            Route::get('/profile/experience','experience')->name('applicant.profile.experience');
            Route::post('/profile/experience/store', 'storeExperience')->name('applicant.profile.experience.store');
            Route::post('/profile/experience/update/{id}', 'updateExperience')->name('applicant.profile.experience.update');
            Route::get('/profile/experience/delete/{id}', 'deleteExperience')->name('applicant.profile.experience.delete');

            //SKills
            Route::get('/profile/skills','skills')->name('applicant.profile.skills');
            Route::post('/profile/skills/store', 'storeSkills')->name('applicant.profile.skills.store');
            Route::post('/profile/skills/update/{id}', 'updateSkills')->name('applicant.profile.skills.update');
            Route::get('/profile/skills/delete/{id}', 'deleteSkills')->name('applicant.profile.skills.delete');

            //Language
            Route::get('/profile/language', 'language')->name('applicant.profile.language');
            Route::post('/profile/language/store', 'storeLanguage')->name('applicant.profile.store');

        });
    });
});