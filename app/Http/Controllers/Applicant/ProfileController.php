<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('applicant.profile.index');
    }

    public function updateInfo(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'identity_no' => 'required|string|digits:16|unique:users,identity_no',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'religion' => 'required|string',
            'marital_status' => 'required|string',
            'nationality' => 'required|string',
        ]);
        return $request->all();
    }

    
}
