<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){
        $apps = Application::where('user_id', Auth::guard('user')->user()->id)->get();
        return view('applicant.application.index',[
            'apps' => $apps
        ]);
    }

    public function detail($id){
        return view('applicant.application.detail',[
            'apl' => Application::find($id),
        ]);
    }
}
