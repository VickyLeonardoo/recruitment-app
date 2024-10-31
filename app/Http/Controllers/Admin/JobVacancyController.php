<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use App\Models\JobVacancy;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;

class JobVacancyController extends Controller
{
    public function index(){
        $title = "Job List";

        return view('admin.job.index',[
            'title' => $title,
            'jobs' => JobVacancy::all(),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function create(){
        $title = "Add Job";

        return view('admin.job.create',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title),
            'departements' => Departement::with('position')->get(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'departement_id' => 'required|integer',
            'requirement' => 'required|string',
            'qualification' => 'required|string',
            'position_id' => 'required|integer',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer',
            'max_pax' => 'required|integer',
        ]);

        $data = [
            'code' => $request->input('code'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'departement_id' => $request->input('departement_id'),
            'requirement' => $request->input('requirement'),
            'qualification' => $request->input('qualification'),
            'position_id' => $request->input('position_id'),
            'type' => $request->input('type'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'min_salary' => $request->input('min_salary'),
            'max_salary' => $request->input('max_salary'),
            'status' => 'Active',
            'max_pax' => $request->max_pax,
        ];
        $job = JobVacancy::create($data);
        return redirect()->route('admin.job')->with('success','Job created successfully');

    }

    public function edit($id){
        $title = "Edit Job";
        $job = JobVacancy::find($id);
        return view('admin.job.edit',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title),
            'departements' => Departement::with('position')->get(),
            'job' => $job,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'code' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'departement_id' => 'required|integer',
            'requirement' => 'required|string',
            'qualification' => 'required|string',
            'position_id' => 'required|integer',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer',
            'max_pax' => 'required|integer',

        ]);

        $data = [
            'code' => $request->input('code'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'departement_id' => $request->input('departement_id'),
            'requirement' => $request->input('requirement'),
            'qualification' => $request->input('qualification'),
            'position_id' => $request->input('position_id'),
            'type' => $request->input('type'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'min_salary' => $request->input('min_salary'),
            'max_salary' => $request->input('max_salary'),
            'max_pax' => $request->max_pax,

        ];
        $job = JobVacancy::find($id);
        $job->update($data);
        return redirect()->route('admin.job')->with('success','Job updated successfully');
    }

    public function getPositions($deptId)
    {
        $positions = Position::where('departement_id', $deptId)->pluck('name', 'id');
        return response()->json($positions);
    }

    public function destroy($id){
        JobVacancy::find($id)->delete();
        return redirect()->route('admin.job')->with('success','Job deleted successfully');
    }
}
