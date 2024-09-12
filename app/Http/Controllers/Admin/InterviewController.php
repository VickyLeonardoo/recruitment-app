<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Models\Schedule;

class InterviewController extends Controller
{
    //
    public function index(){
        $title = 'Interview List';
        return view('admin.interview.index',[
            'title' => $title,
            'interviews' => Schedule::all(),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function create(){
        $title = 'Add Schedule';
        return view('admin.interview.create',[
            'title' => $title,
            'jobs' => JobVacancy::where('status', 'Active')->with('position')->get(),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }
}
