<?php

namespace App\Http\Controllers\Admin;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;

class QuestionController extends Controller
{
    public function index()
    {
        $title = 'Question';
        return view('admin.question.index',[
            'title' => 'Question',
            'questions' => Question::all(),
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function create()
    {
        $title = 'Add Question';
        return view('admin.question.create',[
            'title' => 'Add Question',
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'type' => 'required',
            'description' => 'required',
            'difficult' => 'required'
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/question', $imageName);
            // $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $q = Question::create($data);
        return redirect()->route('admin.question.show',$q->id)->with('success','Question successfully created, next step is to add answer');
    }

    public function show($id){
        $title = 'View Question';
        return view('admin.question.viewQuestion',[
            'title' => $title,
            'question' => Question::find($id),
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function edit(Request $request, $id)
    {
        $title = 'Edit Question';
        return view('admin.question.editQuestion',[
            'title' => $title,
            'question' => Question::find($id),
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function updateQuestion(Request $request, $question_id){
        $question = Question::find($question_id);
        $data = $request->validate([
            'type' => 'required',
            'description' => 'required',
            'difficult' => 'required'
        ]);

        if ($request->hasFile('image')) {
            if ($question->image && file_exists(storage_path('app/public/question/' . $question->image))) {
                unlink(storage_path('app/public/question/' . $question->image));
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/question', $imageName);
            $data['image'] = $imageName;
        }

        $question->update($data);
        return redirect()->route('admin.question.show',$question_id)->with('success','Question successfully updated');
    }

    public function storeAnswer(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'label' => 'required|string|max:255',
            'choice' => 'required_if:answer_type,text|max:255',
            'choice_image' => 'required_if:answer_type,image|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Proses data dan simpan ke database
        $data = [
            'question_id' => $id,
            'label' => $request->input('label'),
            'is_correct' => $request->has('is_correct') ? true : false,
        ];

        if ($request->input('answer_type') == 'text') {
            $data['choice'] = $request->input('choice');
        } elseif ($request->input('answer_type') == 'image' && $request->hasFile('choice_image')) {
            $image = $request->file('choice_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/answer', $imageName);
            // $image->move(public_path('images'), $imageName);
            $data['choice'] = $imageName;
        }

        // Simpan data ke database
        Choice::create($data);

        // Redirect atau kembalikan respon sesuai kebutuhan
        return redirect()->back()->with('success', 'Answer created successfully.');
    }

    public function deleteAnswer(){

    }

}
