<?php

namespace App\Http\Controllers\Applicant;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('applicant.profile.info');
    }

    public function updateInfo(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $user_detail_id = $user->user_detail->id;

        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'identity_no' => 'required|string|digits:16|unique:user_details,identity_no,' . $user_detail_id,
            'dob' => 'required|date',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|unique:user_details,phone,' . $user_detail_id,
            'religion' => 'required|string',
            'status' => 'required|string',
            'nationality' => 'required|string',
        ]);

        // Update data user detail
        $user->user_detail->update($data);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function education(){
        return view('applicant.profile.education');
    }

    
}
