<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOptionRequest;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Models\Categories;
use App\Models\Options;
use App\Models\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    public function index(){
        $questions=Question::all();
       return view('Quiz.questions.index',compact('questions'))->withTitle('liste of question');
    }
    public function create(){
        $categories = Categories::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('Quiz.questions.create',compact('categories'))->withTitle('create question');

    }
    public function store(Request $request){
        $question = Question::create($request->all());
        return redirect()->back()->with('success','question created');

    }
    public function edit($id){
        $question=Question::find($id);
        $categories = Categories::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $question->load('category');
        return view('Quiz.questions.edit',compact('question','categories'))->withTitle('edite questions');
    }
    public function update(Request $request,$id){
        $question=Question::find($id);
        $question->update($request->all());
        return redirect()->back()->with('success','question updated');
    }
    public function destroy($id){
        $options=Question::find($id);
        $options->delete();
    }
    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        Question::whereIn('id', request('ids'))->delete();

        return redirect()->back()->with('success','option deleated ');
    }
}
