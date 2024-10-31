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
        $checkApplication = Application::where('user_id', Auth::guard('user')->id())->latest()->first();
        if ($checkApplication && in_array($checkApplication->status, ['Pending'])) {
            return back()->with('error', 'Gagal! Anda hanya dapat melakukan pendaftaran sekali dalam satu waktu');
        }

        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Ambil data job vacancy dengan penguncian baris
            $jobVacancy = JobVacancy::where('id', $id)->lockForUpdate()->first();

            // Cek apakah jumlah pelamar sudah mencapai batas maksimum
            if ($jobVacancy->application()->count() >= $jobVacancy->max_pax) {
                DB::rollBack();
                return back()->with('error', 'Maaf, jumlah maksimum pelamar telah tercapai.');
            }

            // Generate nomor registrasi
            $reg_no = 'MC' . now()->format('YmdHisu');

            $application = Application::create([
                'reg_no' => $reg_no,
                'user_id' => Auth::guard('user')->id(),
                'job_vacancy_id' => $id,
                'reg_date' => now(),
                'status' => 'pending',
            ]);

            // Generate nomor tes
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

            // Commit transaksi
            DB::commit();

            return redirect()->route('applicant.application.detail', $application->id)
                            ->with('success', 'Berhasil melakukan pendaftaran');
        } catch (\Exception $e) {
            // Rollback jika ada kesalahan
            DB::rollBack();

            // Log error
            Log::error('Error in applyJob: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    
}
