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
            'password' => 'required|string',
            'confirmation_password' => 'required|same:password',
        ]);

        $user = Auth::guard('user')->user();
        $user->password = bcrypt($request->password);
        $user->save();
// Suggested code may be subject to a license. Learn more: ~LicenseLog:2591596858.
        return redirect()->back()->with('success','Password berhasil diubah');
    }
}

