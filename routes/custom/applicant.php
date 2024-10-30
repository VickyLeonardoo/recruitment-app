<?php

use App\Http\Controllers\Applicant\ApplicationController;
use App\Http\Controllers\Applicant\JobVacancyController;
use App\Http\Controllers\Applicant\PasswordController;
use App\Http\Controllers\Applicant\ProfileController;
use App\Http\Controllers\Applicant\TestController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:4']],function(){
        
        Route::controller(PasswordController::class)->group(function(){
            Route::get('/password', 'index')->name('applicant.password');
            Route::post('/password/update', 'update')->name('applicant.password.update');

        });

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
            Route::post('/profile/language/store', 'storeLanguage')->name('applicant.profile.language.store');
            Route::get('/profile/language/delete/{id}', 'deleteLanguage')->name('applicant.profile.language.delete');

            Route::get('/profile/overview', 'overview')->name('applicant.profile.overview');
            Route::post('/profile/picture', 'updateProfilePicture')->name('applicant.profile.picture');
        });

        Route::controller(JobVacancyController::class)->group(function(){
            Route::get('/job-vacancy', 'index')->name('applicant.job');
            Route::get('/job-vacancy/{code}', 'detail')->name('applicant.job.detail');
            Route::post('/job-vacancy/{id}/apply', 'applyJob')->name('applicant.job.apply');
        });

        Route::controller(ApplicationController::class)->group(function(){
            Route::get('/application', 'index')->name('applicant.application');
            Route::get('/application/{id}', 'detail')->name('applicant.application.detail');
        });

        Route::controller(TestController::class)->group(function(){
            Route::post('/application/{id}/test/', 'startTest')->name('applicant.application.test.open');
            Route::get('/application/{id}/test/', 'continueTest')->name('applicant.application.test.index');
            Route::post('/application/{id/test/submit', 'submitTest')->name('applicant.application.test.submit');
            Route::post('/applicaiton/save-answer/','saveAnswer')->name('applicant.application.test.saveAnswer');
            Route::post('/application/test/{id}/','submitApplication')->name('applicant.application.submit');

        });

        
    });
});