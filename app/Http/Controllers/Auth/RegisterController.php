<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\EducationDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'dob' => 'required|date',
            'phone' => 'required|unique:user_details,phone',
            'identity_no' => 'required|digits:16|unique:user_details,identity_no',
            'gender' => 'required',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Kata sandi harus diisi',
            'password.min' => 'Kata sandi minimal 6 karakter',
            'password_confirmation.required' => 'Konfirmasi kata sandi harus diisi',
            'password_confirmation.same' => 'Kata sandi tidak sama',
            'dob.required' => 'Tanggal lahir harus diisi',
            'dob.date' => 'Tanggal lahir tidak valid',
            'phone.required' => 'Nomor telepon harus diisi',
            'identity_no.required' => 'NIK harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'identity_no.digits' => 'NIK harus berisi 16 angka',
            'identity_no.unique' => 'NIK sudah terdaftar',
        ]);
        
        // Add custom age validation
        $validator->after(function ($validator) use ($request) {
            $dob = Carbon::parse($request->dob);
            $nowDate = Carbon::now();
            $age = $dob->diffInYears($nowDate);
        
            if ($age < 18) {
                $validator->errors()->add('dob', 'Usia harus minimal 18 tahun.');
            }
        });
        
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        DB::beginTransaction();

        try {
            // Prepare user data
            $user = [
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hash password
                'is_active' => true,
                'is_verified' => true,
                'role_id' => 4,
            ];

            // Format date of birth
            $dob = Carbon::parse($request->dob)->format('Y-m-d');

            // Create user
            $user_create = User::create($user);

            // Create user detail
            UserDetail::create([
                'user_id' => $user_create->id,
                'full_name' => $request->full_name,
                'dob' => $dob,
                'phone' => $request->phone,
                'identity_no' => $request->identity_no,
                'gender' => $request->gender,
            ]);

            // Log in the user
            Auth::guard('user')->login($user_create);

            // Commit transaction
            DB::commit();

            return redirect()->route('applicant.profile.info')->with('success', 'Registration and Login Successful');
        } catch (\Exception $e) {
            // Rollback transaction if there is any error
            DB::rollBack();

            // Optionally, log the exception
            Log::error('Registration failed: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }    
}
