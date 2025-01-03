<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\InterviewController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\QuestionController;



Route::group(['middleware' => ['auth:staff']],function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::group(['middleware' => ['cek_login:1']],function(){
        //Departement Controller - Mengatur Departement Controller
        Route::controller(DepartementController::class)->group(function(){
            Route::get('/departement', 'index')->name('admin.departement'); //Menampilkan Index
            Route::get('/departement/create', 'create')->name('admin.departement.create'); //Menampilkan halaman create
            Route::get('/departement/edit/{id}', 'edit')->name('admin.departement.edit'); //Menampilkan halaman edit
            Route::post('/departement/store', 'store')->name('admin.departement.store'); //Menambahkan data
            Route::post('/departement/update/{id}', 'update')->name('admin.departement.update'); //Mengupdate data
            Route::get('/departement/delete/{id}', 'destroy')->name('admin.departement.delete'); //Menghapus data
        });

        //Account for Manager or HRD
        Route::controller(AccountController::class)->group(function(){
            Route::get('/account','index')->name('admin.account');
            Route::get('/account/create','create')->name('admin.account.create');
            Route::post('/account/create','store')->name('admin.account.store');
            Route::get('/account/{slug}/edit', 'edit')->name('admin.account.edit');
            Route::post('/account/{id}/update' ,'update')->name('admin.account.update');
            Route::get('/account/{id}/delete', 'destroy')->name('admin.account.delete');
            Route::post('/account/{id}/update/status', 'updateStatus')->name('admin.account.update.status');

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
            Route::get('/question/delete/{id}', 'deleteQuestion')->name('admin.question.delete'); //Menghapus data
            Route::get('/question/show/{id}','show')->name('admin.question.show'); //Menampilkan halaman show
            Route::post('/question/{id}/answer', 'storeAnswer')->name('admin.choice.store'); //Store data answer

            Route::get('/question/answer/delete/{id}', 'deleteAnswer')->name('admin.choice.delete');
        });
    });

    Route::group(['middleware' => ['cek_login:1,2,3']],function(){

        Route::controller(AccountController::class)->group(function(){
            Route::get('/account/password', 'show')->name('admin.account.show.password');
            Route::post('/account/password', 'updatePassword')->name('admin.account.update.password');

        });
 
        Route::controller(JobVacancyController::class)->group(function(){
            Route::get('/job-vacancy', 'index')->name('admin.job');
            Route::get('/job-vacancy/create', 'create')->name('admin.job.create');
            Route::post('/job-vacancy/create', 'store')->name('admin.job.store');
            Route::get('/job-vacancy/edit/{id}', 'edit')->name('admin.job.edit');
            Route::get('/job-vacancy/show/{id}', 'show')->name('admin.job.show');
            Route::get('/get-positions/{deptId}','getPositions')->name('admin.job.get.position');
            // Route::get('/get-positions/{deptId}', [YourController::class, 'getPositions']);
            Route::post('/job-vacancy/update/{id}', 'update')->name('admin.job.update');
            Route::get('/job-vacancy/delete/{id}', 'destroy')->name('admin.job.delete');
        });
        Route::controller(ApplicationController::class)->group(function(){
            Route::get('/job-vacancy/{id}/application/', 'index')->name('admin.application');
            Route::get('/job-vacancy/{id}/application/profile-applicant/{id_application}/', 'profileApplicant')->name('admin.application.profile');
            Route::get('/job-vacancy/{id}/application/result-test/{id_application}/', 'resultTest')->name('admin.application.result');
            Route::get('/application/{id}/rejected','setReject')->name('admin.application.reject');
            Route::get('/application/{id}/accepted','setApproved')->name('admin.application.approved');
            Route::get('/application/{id}/interview','setInterview')->name('admin.application.interview');
            Route::get('/application/{id}/pending','setPending')->name('admin.application.pending');
            Route::get('/application/{id}/recomendation','setRecomendation')->name('admin.application.recomendation');
            Route::get('/application/{id}/mark','setMark')->name('admin.application.mark');
            Route::get('/application/{id}/unmark','setUnmark')->name('admin.application.unmark');
            Route::get('/application/{id}/interview/mass','setMassInterview')->name('admin.application.mass.interview');
            Route::get('/application/{id}/reject/mass','setMassReject')->name('admin.application.mass.reject');

        });

        Route::controller(InterviewController::class)->group(function(){
            Route::get('/interview', 'index')->name('admin.interview');
            Route::get('/interview/create', 'create')->name('admin.interview.create');
            Route::post('/interview/create', 'store')->name('admin.interview.store');
            Route::get('/interview/edit/{id}', 'edit')->name('admin.interview.edit');
            Route::POST('/interview/update/{id}', 'update')->name('admin.interview.update');
            Route::get('/interview/delete/{id}', 'destroy')->name('admin.interview.destroy');
    
            Route::get('/interview/{id}/applicant', 'applicantList')->name('admin.interview.applicant');
            Route::get('/interview/{id}/generate/applicant','generateApplicant')->name('admin.interview.generate.applicant');
            Route::get('/interview/{id}/applicant/{id_apl}/detail', 'applicantDetail')->name('admin.interview.applicant.detail');
    
            Route::get('/interview/{id}/applicant/sentMail', 'sentMail')->name('admin.interview.applicant.mail');
            Route::get('/interview/{id}/applicant/reject', 'rejectLine')->name('admin.interview.applicant.reject');
            Route::get('/interview/{id}/applicant/approve', 'approveLine')->name('admin.interview.applicant.approve');
            Route::get('/interview/{id}/applicant/mark', 'markLine')->name('admin.interview.applicant.mark');
            Route::get('/interview/{id}/applicant/unmark', 'unmarkLine')->name('admin.interview.applicant.unmark');
    
            Route::get('/interview/{id}/set/upcoming','setUpcoming')->name('admin.interview.set.upcoming');
            Route::get('/interview/{id}/set/done','setDone')->name('admin.interview.set.done');
            Route::get('/interview/{id}/set/cancelled','setCancelled')->name('admin.interview.set.cancelled');
            Route::get('/interview/{id}/set/draft','setDraft')->name('admin.interview.set.draft');
    });
        

        // Route::get('/job-vacancy/{id}/application/profile-applicant/{id_application}/', 'profileApplicant')->name('admin.application.profile');


    });
});