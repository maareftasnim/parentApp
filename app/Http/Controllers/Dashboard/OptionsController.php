<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOptionRequest;
use App\Models\Options;
use App\Models\Question;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionsController extends Controller
{
    public function index(){
        $options=Options::all();
        return view('Quiz.Options.index',compact('options'))->withTitle('liset of options');
    }
    public function create(){
        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('Quiz.Options.create', compact('questions'));

    }
    public function store(Request $request){
        $option = Options::create($request->all());
        return redirect()->back()->with('seccess','options created ');
    }
    public function edit($id){
        $options=Options::find($id);
        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');
        $options->load('question');
        return view('Quiz.Options.edit', compact('questions', 'option'));

    }
    public function update(Request $request,$id){
        $options=Options::find($id);
        $options->update($request->all());
        return redirect()->back()->with('seccess','options updated');

    }
    public function destroy($id){
        $options=Options::find($id);
        $options->delete();
        redirect()->back()->with('seccess','options deleted');
    }
    public function massDestroy(MassDestroyOptionRequest $request)
    {
        Options::whereIn('id', request('ids'))->delete();
        return redirect()->back()->with('seccess','option deleated ');

    }
}
