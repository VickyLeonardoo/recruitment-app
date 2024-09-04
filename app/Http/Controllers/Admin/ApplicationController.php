<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;

class ApplicationController extends Controller
{
    public function index($id){
        $job = JobVacancy::find($id);
        $title = "Application List";
        return view('admin.application.index',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }

    public function profileApplicant($id,$id_app){
        $title = "Profile Applicant";
        $job = JobVacancy::find($id);

        return view('admin.application.profile',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }

    public function resultTest($id,$id_app){
        $title = "Result Test";
        $job = JobVacancy::find($id);

        return view('admin.application.result',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title, $job),
        ]);
    }
}
