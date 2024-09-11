<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
