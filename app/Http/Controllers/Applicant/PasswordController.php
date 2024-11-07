<?php

namespace App\Http\Controllers\Applicant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    //
    public function index(){
        return view('applicant.password.index');
    }

    public function update(Request $request){
        $request->validate([
            'password' => 'required|string|min:8',
            'confirmation_password' => 'required|same:password',
        ],[
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa a-z, A-Z, 1-9,!#$%^&*()_+',
            'password.min' => 'Password minimal 8 karakter',
            'confirmation_password.required' => 'Konfirmasi password harus sama',
            'confirmation_password.same' => 'Konfirmasi password tidak sama',
        ]);

        $user = Auth::guard('user')->user();
        $user->password = bcrypt($request->password);
        $user->save();
// Suggested code may be subject to a license. Learn more: ~LicenseLog:2591596858.
        return redirect()->back()->with('success','Password berhasil diubah');
    }
}

