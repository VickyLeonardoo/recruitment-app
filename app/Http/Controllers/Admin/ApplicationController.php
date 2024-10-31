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
        $job = JobVacancy::with([
            'application.user' => function ($query) {
                $query->with([
                    'user_detail',
                    'education_details', 
                    'skill_details',
                ]);
            }
        ])->find($id);
        // $job = JobVacancy::find($id);
        $title = "Application List";
        return view('admin.application.index',[
            'title' => $title,
            'jobs' => $job,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }

    public function profileApplicant($id, $id_app, MonthlyUsersChart $chart) {
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

        $answer = $application->test->test_result;
        $correctAnswer = 0;

        // Check if there are answers before processing
        if ($answer && $answer->count() > 0) {
            foreach ($answer as $ans) {
                if ($ans->is_correct) {
                    $correctAnswer++;
                }
            }
            
            // Calculate the final grade if there are answers
            $finalGrade = ($correctAnswer / $answer->count()) * 100;
        } else {
            // If no answers, set final grade to 0
            $finalGrade = 0;
        }

        return view('admin.application.profile', [
            'user' => $user,
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
            'grade' => $finalGrade,
            'chart' => $chart->build($application),
            'apl' => $application
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
    
    // Pending','Interview','Approved','Rejected

    public function setPending($id){
        $application = Application::find($id);
        $application->status = 'Pending';
        $application->save();
        return redirect()->back()->with('success','Update successfully');
    }

    public function setReject($id){
        $application = Application::find($id);
        $application->status = 'Rejected';
        $application->save();
        return redirect()->back()->with('success','Update successfully');
    }

    public function setInterview($id){
        $application = Application::find($id);
        $application->status = 'Interview';
        $application->save();
        return redirect()->back()->with('success','Update successfully');
}

    public function setApproved($id){
        $application = Application::find($id);
        $application->status = 'Approved';
        $application->save();
        return redirect()->back()->with('success','Update successfully');
    }

    public function setRecomendation($id){
        $application = Application::find($id); 
        if ($application->is_recomended == true) {
            $application->is_recomended = false;
        }else{
            $application->is_recomended = true;
        }
        $application->save();
        return redirect()->back()->with('success','Update successfully');
    }

    public function setMark($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['is_mark' => true]);
    
        return redirect()->back()->with('success', 'Applications marked successfully');
    }
    
    public function setUnmark($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['is_mark' => false]);
    
        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function setMassInterview($ids){
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['status' => 'Interview']);

        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function setMassReject($ids){
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Applications marked successfully');
    }
}
