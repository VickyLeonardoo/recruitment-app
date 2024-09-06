<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Test;
use App\Models\Question;
use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //
    public function startTest($id) {
        $test = Test::find($id);
        if (!$test->start_time) {
            $test->start_time = now();
            $test->is_start == true;
            $test->status == 'OPEN';
            $test->save();
        }


        // Ambil 20 soal acak
        $questions = Question::inRandomOrder()->take(20)->get();
        
        // Ambil ID user yang sedang login (asumsi menggunakan auth)
        
        // Loop untuk setiap soal dan buat entry di test_results
        foreach ($questions as $index => $question) {
            TestResult::create([
                'test_id' => $id,            // ID dari tes yang diikuti, dari parameter $id
                'question_id' => $question->id, // ID soal
                'choice_id' => null,         // Jawaban user (belum dijawab, jadi null dulu)
                'is_correct' => false,       // Belum dijawab, jadi anggap salah dulu
                'no' => $index + 1           // Nomor urut soal
            ]);
        }

        return redirect()->back()->with('success','Tes dimulai!');
    }

    public function continueTest(){

    }
}
