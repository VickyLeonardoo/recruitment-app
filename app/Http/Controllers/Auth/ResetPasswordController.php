<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    //
    public function store(){

    }
    public function resetPassword($token){
        $userFind = ResetPassword::where('token',$token)->first();
        if (!$userFind || $userFind->created_at->addMinutes(10) < Carbon::now()) {
            $userFind = false; // Token tidak valid (token tidak ditemukan atau sudah lebih dari 10 menit)
        }
        return view('auth.reset-password',[
            'user' => $userFind,
        ]);
    }

    public function processResetPassword(Request $request, $token){
        $request->validate([
            'password' => 'required|min:3',
            'password_confirmation' => 'same:password'
        ]);

        $userFind = ResetPassword::where('token',$token)->first();

        if ($userFind->user_id) {
            $userFind->user->password = $request->input('password');
            $userFind->user->save();
            $userFind->delete();
        }else{
            $userFind->staff->password = $request->password;
            $userFind->staff->save();
            $userFind->delete();
        }
        return redirect(route('auth.login'))->with('success','Password successfully changed');
    }

}
