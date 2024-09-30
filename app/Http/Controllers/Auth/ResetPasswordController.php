<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function index(){
        return view('auth.reset');
    }
    public function store(Request $request){
        $request->validate([
                'email' => 'required',
        ]);
        $token = bin2hex(random_bytes(32));

        $user = [];
        $userFind = User::where('email',$request->email)->first();
        $staffFind  = Staff::where('email',$request->email)->first(); 
        $data = [];
        if ($userFind) {
            $user = [
                'token' => $token,
                'user_id' => $userFind->id,
            ];
            $data = $userFind;
        }elseif ($staffFind) {
            $user = [
                'token' => $token,
                'staff_id' => $staffFind->id,
            ];
            $data = $staffFind;
        }else{
            return redirect()->back()->with('error','Email not found');
        }
        ResetPassword::create($user);
        Mail::to($data['email'])->send(new ResetPasswordMail($data, $token));
        return redirect(route('auth.login'))->with('success','Password reset link has been sent to your email');
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
        if (!$userFind || $userFind->created_at->addMinutes(10) < Carbon::now()) {
            return redirect()->back()->withErrors('error', 'Token no longer valid');
        }

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
