<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\JobVacancy;
use App\Models\Application;
use App\Models\ScheduleLine;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;
use App\Http\Controllers\Controller;
use App\Mail\CancelInterview;
use App\Mail\SentInterviewMail;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Mail;

class InterviewController extends Controller
{
    //
    public function index(){
        $title = 'Interview List';
        return view('admin.interview.index',[
            'title' => $title,
            'interviews' => Schedule::with('line')->get(),
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

    public function store(Request $request){
        $data = $request->validate([
            'job_vacancy_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $job = JobVacancy::find($request->job_vacancy_id);
        if (strtotime($request->date) < strtotime($job->start_date)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['date' => 'Date must be greater than or equal to start date']);
        }
        
        $startDateTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $endDateTime = Carbon::parse($request->date . ' ' . $request->end_time);

        if ($endDateTime->lte($startDateTime)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['end_time' => 'End time must be after start time']);
        }

        Schedule::create($data);
        return redirect(route('admin.interview'))->with('success','Success add schedule');
    }

    public function edit($id){
        $title = 'Edit Schedule';
        return view('admin.interview.edit',[
            'schedule' => Schedule::find($id),
            'title' => $title,
            'jobs' => JobVacancy::where('status', 'Active')->with('position')->get(),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function update(Request $request,$id){
        $data = $request->validate([
            'job_vacancy_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $schedule = Schedule::find($id)->load('job');

        
        if (strtotime($request->date) < strtotime($schedule->job->start_date)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['date' => 'Date must be greater than or equal to start date']);
        }

        $startDateTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $endDateTime = Carbon::parse($request->date . ' ' . $request->end_time);

        if ($endDateTime->lte($startDateTime)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['end_time' => 'End time must be after start time']);
        }
        $schedule->update($data);

        return redirect(route('admin.interview'))->with('success','Success update schedule');
    }

    public function destroy($id){
        $schedule = Schedule::find($id);
        if ($schedule->status != 'Cancelled') {
            if ($schedule->line) {
                return redirect()->back()->with('error','Schedule has lines, cannot delete');
            }
        }
        Schedule::find($id)->delete();
        return redirect(route('admin.interview'))->with('success','Success delete schedule');
    }

    public function setUpcoming($id){
        $schedule = Schedule::find($id);
        $schedule->update(['status' => 'Upcoming']);
        return redirect(route('admin.interview'))->with('success','Success update schedule');
    }

    public function setDone($id){
        $schedule = Schedule::find($id);
        $schedule->update(['status' => 'Done']);
        return redirect(route('admin.interview'))->with('success','Success update schedule');
    }

    public function setCancelled($id){
        $schedule = Schedule::find($id);
        
        $schedule->update(['status' => 'Cancelled']);

        foreach ($schedule->line as $line) {
            $line->application->is_interview = 0;
            $line->application->save();
        }
        $users = $schedule->line->pluck('application.user')->unique();
        
        foreach ($users as $user) {
            Mail::to($user->email)->send(new CancelInterview($schedule,$user));
        }

        return redirect(route('admin.interview'))->with('success','Success update schedule');
    }

    public function setDraft($id){
        $schedule = Schedule::find($id);
        $schedule->update(['status' => 'Draft']);
        return redirect(route('admin.interview'))->with('success','Success update schedule');
    }

    public function applicantList($id){
        $schedule = Schedule::find($id)->load([
            'line.application.user.user_detail', 
        ]);
        $title = 'Applicant List';
        return view('admin.interview.applicant',[
            'schedule' => $schedule,
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title,$id),
        ]); 
    }

    public function generateApplicant($id){
        $schedule = Schedule::find($id);
        $aplications = Application::where('status', 'Interview')->where('is_interview',false)->where('job_vacancy_id',$schedule->job_vacancy_id)->get();
        foreach ($aplications as $apl) {
            ScheduleLine::create([
                'schedule_id' => $id,
                'application_id' => $apl->id,
            ]);
            $apl->is_interview = true;
            $apl->save();
        }
        return redirect()->back()->with('success','Success generate applicant');
    }

    public function applicantDetail($id, $id_apl, MonthlyUsersChart $chart) {
        $title = "Applicant Profile";
    
        // Eager load relasi schedule dengan line dan application beserta job dan user terkait
        $schedule = Schedule::with([
            'line.application.job', // Eager load job dari application
            'line.application.user.user_detail',
            'line.application.user.education_details',
            'line.application.user.skill_details',
            'line.application.test.test_result'
        ])->find($id);
    
        // Ambil apl yang spesifik
        $apls = $schedule->line->where('application_id', $id_apl)->first();
        $jobId = $apls->application->job->id;
    
        // Ambil aplikasi spesifik
        $application = $apls->application;
    
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
            'breadcrump' => Breadcrumbs::render($title, $apls->application,$id),
            'grade' => $finalGrade,
            'chart' => $chart->build($application),
            'apl' => $application
        ]);
    }
 
    public function sentMail($id)
    {
        // Eager load relasi line, application, dan user, serta filter line dengan is_mail = false
        $schedule = Schedule::with(['line' => function($query) {
            $query->where('is_email', false)->with('application.user');
        }])->find($id);

        if (!$schedule || $schedule->line->isEmpty()) {
            return redirect()->back()->with('error', 'No lines found for this schedule.');
        }

        // Ambil semua user dari setiap line->application
        $users = $schedule->line->pluck('application.user')->unique();
        
        // Jika kamu hanya ingin mendapatkan email
        $emails = $users->pluck('email')->unique();
        // Proses pengiriman email hanya untuk yang is_mail = false
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SentInterviewMail($schedule,$user));
        }

        // Update is_mail menjadi true hanya untuk line yang is_mail = false
        $schedule->line()->where('is_email', false)->update(['is_email' => true]);
        return redirect()->back()->with('success','Success send email');
    }

    public function rejectLine($ids)
    {
        $lineIds = explode(',', $ids); // Get array of IDs

        // Update result status for all lines
        ScheduleLine::whereIn('id', $lineIds)->update(['result' => 'Rejected']);

        // Update status for related applications in bulk
        $applicationIds = ScheduleLine::whereIn('id', $lineIds)
                                    ->pluck('application_id')
                                    ->unique(); // Get unique application IDs

        // Update status for all applications
        Application::whereIn('id', $applicationIds)->update(['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function approveLine($ids)
    {
        $lineIds = explode(',', $ids); // Get array of IDs

        // Update result status for all lines
        ScheduleLine::whereIn('id', $lineIds)->update(['result' => 'Approved']);

        // Update status for related applications in bulk
        $applicationIds = ScheduleLine::whereIn('id', $lineIds)
                                    ->pluck('application_id')
                                    ->unique(); // Get unique application IDs

        // Update status for all applications
        Application::whereIn('id', $applicationIds)->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function markLine($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
       
        ScheduleLine::whereIn('id', $applicationIds)->update(['is_mark' => true]);
    
        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function unmarkLine($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
        ScheduleLine::whereIn('id', $applicationIds)->update(['is_mark' => false]);
    
        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    
}
