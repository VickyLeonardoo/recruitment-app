<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $kredensil = $request->only('email','password');
        if (Auth::guard('staff')->attempt($kredensil)) {
            $user = Auth::guard('staff')->user();
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard')->with('success','Login Successfully');
            }elseif ($user->role_id == 2) {
                return redirect()->route('admin.dashboard')->with('success','Login Successfully');
            }else{
                return redirect()->route('admin.dashboard')->with('success','Login Successfully');
            }
        }elseif (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role_id == 4) {
                if ($user->is_active == true) {
                    if ($user->is_verified == true) {
                        return redirect()->route('applicant.profile.info')->with('success','Login Successfully');
                    }else{
                        return redirect()->back()->with('error','Your account is not verified');
                    }
                }else{
                    return redirect()->back()->with('error','Your account is not active');
                }
            }
        }
        return redirect()->back()->with('error','Login Gagal, Email atau Password Kamu Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login')->with('success','Successfully Logged Out');
    }
}
