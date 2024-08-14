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

        $q = Question::create($data);
        return redirect()->route('admin.question.editAnswer',$q->id)->with('success','Question successfully created, next step is to add answer');
    }

    public function editAnswer(Request $request, $id)
    {
        $title = 'Add Answer';
        return view('admin.question.editAnswer',[
            'title' => $title,
            'question' => Question::find($id),
            'breadcrump' => Breadcrumbs::render($title)
        ]);
    }

    public function updateAnswer(Request $request, $question_id){
    }

}
