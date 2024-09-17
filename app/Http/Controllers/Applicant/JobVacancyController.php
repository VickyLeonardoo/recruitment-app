<?php

namespace App\Http\Controllers\Applicant;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        $job = JobVacancy::where('code',$code)->first();

        $check = Application::where('user_id',Auth::guard('user')->user()->id)->where('job_vacancy_id',$job->id)->first();
        if($check){
            $is_applied = $check;
        }

        return view('applicant.job.detail',[
            'job' => $job,
            'is_applied' => $is_applied,
        ]);
    }

    public function applyJob($id)
    {
        $checkAppliation = Application::where('user_id',Auth::guard('user')->id())->latest()->first();
        if ($checkAppliation) {
            if (in_array($checkAppliation->status, ['Pending'])) {
                return back()->with('error', 'Gagal! Anda hanya dapat melakukan pendaftaran sekali dalam satu waktu');
            }
        }

        try {
            // Start the transaction
            DB::beginTransaction();

            // Generate reg_no with format MC{year}{month}{day}{microsecond}
            $reg_no = 'MC' . now()->format('YmdHisu');

            $application = Application::create([
                'reg_no' => $reg_no,
                'user_id' => Auth::guard('user')->id(),
                'job_vacancy_id' => $id,
                'reg_date' => now(),
                'status' => 'pending',
            ]);

            $lastTestNumber = Test::max('test_no') ?? 'PT000000';
            $newTestNumber = 'PT' . str_pad(intval(substr($lastTestNumber, 2)) + 1, 6, '0', STR_PAD_LEFT);

            Test::create([
                'test_no' => $newTestNumber,
                'user_id' => Auth::guard('user')->id(),
                'status' => 'DRAFT',
                'name' => 'Basic External',
                'duration' => '40',
                'application_id' => $application->id,
            ]);

            // If we've gotten this far, it means both inserts were successful.
            // So, let's commit the transaction.
            DB::commit();

            return redirect()->route('applicant.application.detail', $application->id)
                            ->with('success', 'Berhasil melakukan pendaftaran');
        } catch (\Exception $e) {
            // Something went wrong, let's rollback the transaction
            DB::rollBack();

            // Log the error
            Log::error('Error in applyJob: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    
}
