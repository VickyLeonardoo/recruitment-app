<?php

namespace App\Http\Controllers\Applicant;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\EducationDetail;
use App\Models\ExperienceDetail;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\LanguageDetail;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('applicant.profile.info');
    }

    public function updateInfo(Request $request) {
        $user = Auth::user();
        $user_id = $user->id;
    
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'identity_no' => 'required|string|digits:16|unique:user_details,identity_no,' . ($user->user_detail->id ?? 'NULL'),
            'dob' => 'required|date',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|unique:user_details,phone,' . ($user->user_detail->id ?? 'NULL'),
            'religion' => 'required|string',
            'status' => 'required|string',
            'nationality' => 'required',
        ]);
        // Hitung usia berdasarkan tanggal lahir
        $age = Carbon::parse($request->dob)->age;
    
        // Jika usia kurang dari 18 tahun, kembalikan dengan error
        if ($age < 18) {
            return redirect()->back()->withErrors(['dob' => 'Umur minimal adalah 18 tahun.'])->withInput();
        }
    
        // Cek apakah user_detail sudah ada
        if ($user->user_detail) {
            // Jika user_detail ada, lakukan update
            $user->user_detail->update($data);
        } else {
            // Jika user_detail tidak ada, buat data baru
            $user->user_detail()->create($data);
        }
    
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function education(){
        return view('applicant.profile.education');
    }

    public function storeEducation(Request $request){
        $data = $request->validate([
            'degree' => 'required|string',
            'major' => 'required|string',
            'university' => 'required|string',
            'entry_year' => 'required|digits:4',
            'end_year' => 'required|digits:4',
            'grade' => 'required|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
        ],[
            'degree.required' => 'Jenjang pendidikan harus diisi',
            'major.required' => 'Jurusan harus diisi',
            'university.required' => 'Institusi harus diisi',
            'entry_year.required' => 'Tahun masuk harus diisi',
            'end_year.required' => 'Tahun keluar harus diisi',
            'grade.required' => 'Nilai harus diisi',
            'grade.regex' => 'Nilai harus berupa angka',
            'grade.numeric' => 'Nilai harus berupa angka',
        ]);

        $user = Auth::user();
        $data['user_id'] = $user->id;

        EducationDetail::create($data);
        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function updateEducation(Request $request,$id){
        session()->flash('edit_id', $id);

        $data = $request->validate([
            'degree' => 'required|string',
            'major' => 'required|string',
            'university' => 'required|string',
            'entry_year' => 'required|digits:4',
            'end_year' => 'required|digits:4',
            'grade' => 'required|numeric|regex:/^\d{1,3}(\.\d{1,2})?$/',
        ],[
            'degree.required' => 'Jenjang pendidikan harus diisi',
            'major.required' => 'Jurusan harus diisi',
            'university.required' => 'Institusi harus diisi',
            'entry_year.required' => 'Tahun masuk harus diisi',
            'end_year.required' => 'Tahun keluar harus diisi',
            'grade.required' => 'Nilai harus diisi',
            'grade.regex' => 'Nilai harus berupa angka',
            'grade.numeric' => 'Nilai harus berupa angka',
        ]);


        $education = EducationDetail::find($id);
        $education->update($data);
        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function deleteEducation(Request $request, $id){
        $education = EducationDetail::find($id);
        $education->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }

    public function experience(){
        return view('applicant.profile.experience');
    }    

    public function storeExperience(Request $request){
        $data = $request->validate([
            'company_name' => 'required|string',
            'designation' => 'required|string',
            'entry_date' => 'required|date',
            'end_date' => 'required|date',
        ],[
            'company_name.required' => 'Nama perusahaan harus diisi',
            'designation.required' => 'Jabatan harus diisi',
            'entry_date.required' => 'Tahun masuk harus diisi',
            'end_date.required' => 'Tahun keluar harus diisi',
            'entry_date.date' => 'Tahun masuk harus berupa tanggal',
            'end_date.date' => 'Tahun keluar harus berupa tanggal',
        ]);

        $entry_date = Carbon::parse($request->entry_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        $data['entry_date'] = $entry_date;
        $data['end_date'] = $end_date;

        $user = Auth::user();
        $data['user_id'] = $user->id;

        ExperienceDetail::create($data);
    return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function updateExperience(Request $request,$id){
        session()->flash('edit_id', $id);

        $data = $request->validate([
            'company_name' => 'required|string',
            'designation' => 'required|string',
            'entry_date' => 'required|date',
            'end_date' => 'required|date',
        ],[
            'company_name.required' => 'Nama perusahaan harus diisi',
            'designation.required' => 'Jabatan harus diisi',
            'entry_date.required' => 'Tahun masuk harus diisi',
            'end_date.required' => 'Tahun keluar harus diisi',
            'entry_date.date' => 'Tahun masuk harus berupa tanggal',
            'end_date.date' => 'Tahun keluar harus berupa tanggal',
        ]);

        $entry_date = Carbon::parse($request->entry_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        $education = ExperienceDetail::find($id);
        $education->update($data);

        return redirect()->back()->with('success','Data berhasil disimpan');

    }

    public function deleteExperience(Request $request, $id){
        $experience = ExperienceDetail::find($id);
        $experience->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }

    public function skills(){
        return view('applicant.profile.skills');
    }

    public function storeSkills(Request $request){
        $request->validate([
            'name' => 'required|string',
        ],[
            'name.required' => 'Nama keahlian harus diisi',
        ]);

        $user = Auth::user();
        $data = $request->only(['name']);
        $data['user_id'] = $user->id;

        $user->skill_details()->create($data);
        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function updateSkills(Request $request,$id){
        session()->flash('edit_id', $id);

        $request->validate([
            'name' => 'required|string',
        ],[
            'name.required' => 'Nama keahlian harus diisi',
        ]);

        $skill = Skill::find($id);
        $skill->update($request->only(['name']));
        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function deleteSkills(Request $request, $id){
        $skill = Skill::find($id);
        $skill->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }

    public function language(){
        return view('applicant.profile.language',[
            'langs' => Language::all(),
        ]);
    }

    public function storeLanguage(Request $request){
        $data = $request->validate([
            'language_id' => 'required',
            'level' => 'required'
        ],[
            'language_id.required' => 'Nama bahasa harus diisi',
            'level.required' => 'Level keahlian harus diisi',
        ]);

        $user = Auth::user();
        $data['user_id'] = $user->id;

        $user->language_details()->create($data);
        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function deleteLanguage(Request $request, $id){
        $language = LanguageDetail::find($id);
        $language->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }

    public function overview(){
        return view('applicant.profile.overview',[
            'user' => Auth::user(),
        ]);
    }

    public function updateProfilePicture(Request $request){
        $user = Auth::user();

        $request->validate([
            'profile_picture' => 'required|mimes:png,jpg'
        ],[
           'profile_picture.required' => 'Foto profil harus diisi'
        ]);

        if ($request->hasFile('profile_picture')) {
            
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->user_detail->profile_picture && file_exists(storage_path('app/public/question/' . $user->user_detail->profile_picture))) {
                unlink(storage_path('app/public/profile-picture/' . $user->user_detail->profile_picture));
            }
            $image = $request->file('profile_picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/profile-picture', $imageName);
            $data['image'] = $imageName;
        }


        if ($user->user_detail) {
            $user->user_detail->profile_picture = $imageName;
            $user->user_detail->save();
        }else{
            $user->user_detail()->create([
                'profile_picture' => $request->profile_picture,
            ]);
        }

        return redirect()->back()->with('success','Foto profil berhasil diupload');


    }




}
