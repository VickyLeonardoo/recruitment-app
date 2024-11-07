<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Models\Position;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Diglactic\Breadcrumbs\Breadcrumbs;

class AccountController extends Controller
{
    public function index(){
        $title = 'Account List';
        return view('admin.account.index',[
            'title' => $title,
            'staffs' => Staff::orderBy('role_id','desc')->with('role')->with('departement')->get(),
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function create(){
        return view('admin.account.create',[
            'title' => 'Add Account',
            'departements' => Departement::all()->load('position'),
            'breadcrump' => Breadcrumbs::render('Add Account'),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'departement_id' => 'required',
            'position_id' => 'required',
            'role_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'departement_id' => $request->departement_id,
            'position_id' => $request->position_id,
            'role_id' => $request->role_id,
            'is_active' => true,
            'password' => bcrypt('123'),
            'is_internal' => true,
        ];

        
        $staff = Staff::create($data);
        $token = bin2hex(random_bytes(32));
        $reset = [
            'token' => $token, 
            'staff_id' => $staff->id,
        ];

        ResetPassword::create($reset);
        Mail::to($data['email'])->send(new ResetPasswordMail($data, $token));
        return redirect()->route('admin.account')->with('success', 'Success Add Account');
    }

    public function edit($id){
        $staff = Staff::where('id', $id)->with('role')->with('position.departement')->first();
        $title = 'Edit Account';
        return view('admin.account.edit',[
            'title' => $title,
            'staff' => $staff,
            'departements' => Departement::all()->load('position'),
            'breadcrump' => Breadcrumbs::render($title,$staff),
        ]);
    }

    public function update(Request $request, $id){
        $staff = Staff::find($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'sometimes|required|email',
            'departement_id' => 'required',
            'position_id' => 'required',
            'role_id' => 'required',
        ]);

        $staff->update($data);
        return redirect()->route('admin.account')->with('success', 'Success Update Account');
    }

    public function updateStatus($id){
        $staff = Staff::find($id);
        $staff->is_active = ($staff->is_active == 0) ? 1 : 0;
        $staff->save();
        return redirect()->route('admin.account')->with('success', 'Success Update Account');
    }

    public function destroy($id){
        Staff::where('id', $id)->delete();
        return redirect()->route('admin.account')->with('success', 'Success Delete Account');
    }

    public function show(){
        $title = 'Change Password';
        return view('admin.password.show',[
            'title' => 'Change Password',
            'breadcrump' => Breadcrumbs::render($title),
        ]);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = Auth::guard('staff')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success','Success Update Password');
    }

}
