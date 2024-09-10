<?php

namespace App\Http\Controllers\Admin;

use App\Charts\MonthlyUsersChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;

class ApplicationController extends Controller
{
    public function index($id){
        $job = JobVacancy::find($id);
        $title = "Application List";
        return view('admin.application.index',[
            'title' => $title,
            'jobs' => $job,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }

    public function profileApplicant($id, $id_app) {
        $title = "Profile Applicant";
    
        // Eager load semua relasi yang diperlukan
        $job = JobVacancy::with([
            'application.user' => function ($query) {
                $query->with([
                    'user_detail',
                    'education_details', 
                    'skill_details',
                ]);
            }
        ])->find($id);
    
        // Ambil aplikasi spesifik
        $application = $job->application->where('id', $id_app)->first();
    
        // Ambil user dari application
        $user = $application->user;
    
        return view('admin.application.profile', [
            'user' => $user,
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }

    public function resultTest($id,$id_app, MonthlyUsersChart $chart){
        $title = "Result Test";
        $job = JobVacancy::find($id);
        $application = Application::with('test.test_result.question')->find($id);
        // $application = $job->application->where('id', $id_app)->first();
        $answer = $application->test->test_result;

        $correctAnswer = 0;
        foreach ($answer as $ans ) {
            if ($ans->is_correct) {
                $correctAnswer++;
            }
        }

        $finalGrade = $correctAnswer / $answer->count() * 100;
        
       
        return view('admin.application.result',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
            'grade' => $finalGrade,
            'chart' => $chart->build($application),
        ]);
    }
}
