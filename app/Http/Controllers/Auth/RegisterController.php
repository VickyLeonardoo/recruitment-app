<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\EducationDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function processRegister(Request $request){
        $request->validate([
            'full_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = [
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
            'is_active' => true,
            'is_verified' => true,
            'role_id' => 4,
        ];

        $user_create = User::create($user);
        UserDetail::create([
            'user_id' => $user_create->id,
            'full_name' => $request->full_name,
        ]);

        Auth::guard('user')->login($user_create);
        return redirect()->route('applicant.profile')->with('success', 'Registration and Login Successful');
    }    
}
