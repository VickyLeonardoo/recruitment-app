<?php

namespace App\Http\Controllers\Applicant;

use Carbon\Carbon;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    //
    public function index(){
        return view('applicant.job.index',[
            'jobs' => JobVacancy::where('status','active')->get(),
        ]);
    }

    public function detail($code){
        $is_applied = false;

        $check = Application::where('user_id',Auth::guard('user')->user()->id)->where('job_vacancy_id',JobVacancy::where('code',$code)->first()->id)->first();
        if($check){
            $is_applied = true;
        }

        $job = JobVacancy::where('code',$code)->first();
        return view('applicant.job.detail',[
            'job' => $job,
            'is_applied' => $is_applied,
        ]);
    }

    public function applyJob($id) {
        // Generate reg_no with format MC{year}{month}{day}{random 3 digits}
        $datePart = Carbon::now()->format('Ymd');
        $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $reg_no = 'MC' . $datePart . $randomNumber;
        // Ensure reg_no is unique
        while (Application::where('reg_no', $reg_no)->exists()) {
            $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $reg_no = 'MC' . $datePart . $randomNumber;
        }
    
        $data = [
            'reg_no' => $reg_no,
            'user_id' => Auth::guard('user')->user()->id,
            'job_vacancy_id' => $id,
            'reg_date' => Carbon::now(),
            'status' => 'pending',
        ];
    
        Application::create($data);
        return redirect()->back()->with('success', 'Berhasil melakukan pendaftaran');
    }
}
