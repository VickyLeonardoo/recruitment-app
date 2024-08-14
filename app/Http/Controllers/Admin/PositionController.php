<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departement;
use Diglactic\Breadcrumbs\Breadcrumbs;

class PositionController extends Controller
{
    public function index($slug)
    {
        $title = 'Position List';
        $departement = Departement::where('slug', $slug)->with('position')->first();
        return view('admin.position.index',[
            'title' => $title,
            'departements' => $departement,
            'breadcrump' => Breadcrumbs::render('Position List', $departement),
        ]);
    }

    public function create($slug)
    {
        $departement = Departement::where('slug', $slug)->first();
        $title = 'Create Position';
        return view('admin.position.create',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render('Add Position' ,$departement),
            'departements' => $departement,
        ]);
    }

    public function store(Request $request, $slug){
        $departement = Departement::where('slug', $slug)->first();
        $request->validate([
            'code' => 'required|unique:positions',
            'name' => 'required',
        ]);
        $data = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'departement_id' => $departement->id,
        ];

        Position::create($data);
        return redirect()->route('admin.position',$slug)->with('success','Position created successfully');
    }

    public function edit($slug, $id)
    {
        $position = Position::find($id);
        $title = 'Edit Position';
        return view('admin.position.edit',[
            'title' => $title,
            'position' => $position,
            'breadcrump' => Breadcrumbs::render('Edit', $position),
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'code' => 'required|string|unique:positions,code,' . $id,
            'name' => 'required',
        ]);

        $position = Position::find($id);
        $position->code  = $request->code;
        $position->name = $request->name;
        $position->save();

        return redirect()->route('admin.position',$position->departement->slug)->with('success','Position updated successfully');
    }

    public function destroy($id)
    {
        Position::find($id)->delete();
        return redirect()->back()->with('success','Position deleted successfully');

    }
}
