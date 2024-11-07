<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;

class DepartementController extends Controller
{
    public function index(){
        $title = "Departement List";

        return view('admin.departement.index',[
            'title' => $title,
            'departements' => Departement::all(),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function create(){
        $title = "Add Departement";
        return view('admin.departement.create',[
            'title' => $title,
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:departements,code',
            'name' => 'required|string',
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;

        // Cek apakah slug sudah ada di database dan lakukan increment jika ada duplikat
        while (Departement::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'slug' => $slug
        ];

        Departement::create($data);
        return redirect()->route('admin.departement')->with('success', 'You have successfully added a new department!');
    }


    public function edit($id){
        $title = "Edit Departement";
        return view('admin.departement.edit',[
            'title' => $title,
            'departement' => Departement::find($id),
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function update($id,Request $request){
        $request->validate([
            'code' => 'required|string|unique:departements,code,' . $id,
            'name' => 'required|string',
        ]);

        $data = [
            'code' => $request->code,
            'name' => $request->name,
        ];
        Departement::find($id)->update($data);
        return redirect()->route('admin.departement')->with('success','You have successfully updated departement!');
    }

    public function destroy($id){
        $dept = Departement::find($id);
        $searchPosition = Position::where('departement_id', $dept->id)->count();
        if ($searchPosition > 0) {
            return redirect()->back()->with('error','You cannot delete the departement because it has a relation with other field!');
        }else{
            $dept->delete();
            return redirect()->route('admin.departement')->with('success','You have successfully deleted departement!');
        }
    }
}
