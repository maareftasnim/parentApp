<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Classe;
use App\Models\QuizName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizNameController extends Controller
{
    public function create(){
        $userId=Auth::guard('teachers')->user();
        $id= $userId->id;
        $coursId=DB::table('teacher_classe')->where('teachers_id',$id)->pluck('classe_id');
        foreach ($coursId as $cour){
            $data=json_decode($cour,true);
        }
        $class=DB::table('classe')->whereIn('id',$data)->pluck('title','id');
        //$class=Classe::all()->pluck('title','id')->prepend(trans('global.pleaseSelect'), '');
        return view('Quiz.QuizName.create',compact('class','id'))->withTitle('create quiz');
    }
    public function index(){
        $quiz=QuizName::get();
        return view ('Quiz.QuizName.index',compact('quiz'))->withTitle('liste des quiz');
    }
    public function store(Request $request){
        $quiz=QuizName::create($request->all());
        return redirect()->back()->with('success','quiz added');
    }
    public function edit($id){
        $quiz=QuizName::find($id);
        return view('Quiz.Categories.edit',compact('quiz'))->withTitle('edite quiz');
    }
    public function update(Request $request,$id)
    {
        try {
            $quiz=QuizName::find($id);
            $quiz->update($request->all());
            return redirect()->back()->with('sucess','quiz updated');
        }catch (\Exception $e)
        {
            return  $e->getMessage();
        }

    }
    public function destroy($id){

    }
}
