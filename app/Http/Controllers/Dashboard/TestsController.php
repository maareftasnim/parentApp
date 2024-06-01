<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Options;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Tinker\ClassAliasAutoloader;
use function Sodium\compare;

class TestsController extends Controller
{
    public function index($id)
    {
        $etudiant=Etudiant::find($id);
        //$class=Etudiant::where('',$id);
        $categories = Categories::with(['categoryQuestions' => function ($query) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
            ->whereHas('categoryQuestions')
            ->where('class_id',$etudiant->class_id)
            ->get();
        $time=Question::where('time',60)->get();
        session(['finished' => true]);
           // ->forPage(request()->input('page', 1), 1);
            //dd($categories );
        return view('Quiz.Test.test', compact('categories','time','etudiant'));
    }

    public function store(Request $request)
    {
        $etudiant = Etudiant::find($request->input('user_id'));
        $options = Options::find(array_values($request->input('questions')));
        $total_points = $options->sum('points');

        $resultat = $etudiant->userResults()->create([
            'total_points' => $total_points,
            'user_id' => $request->input('user_id'),
        ]);

        $questions = [];
        foreach ($options as $option) {
            $questions[] = [
                'option_id' => $option->id,
                'points' => $option->points,
                'question_id' => $option->question_id,
            ];
        }

        $resultat->questions()->sync($questions);

        return view('Quiz.Resultat.show', compact('resultat'));
    }
    public function bringThem(){

        if(request()->input('time') && request()->session()->has('questions')){
            $questions = DB::table('quiz_questions')
                ->limit(request()->session()->get("questions"))
                ->simplePaginate(1);

            foreach($questions as $question){
                if(request()->session()->has($question->id)){
                }else{
                    session([$question->id => $question->trueOption]);
                }

            }

            return view('welcome', [
                'questions' => $questions
            ]);
        }else{
            return view('welcome');
        }
    }

    public function storetest(Request $request)
    {
        $request->validate([
            'time' => 'required|numeric|min:15|max:120',
            'questions' => 'required|numeric|min:1|max:10',
        ]);


       // session(['time' => $request->input('time'), 'questions' => $request->input('questions')]);
        $time=Question::where('id',1)->pluck('time');
        $question=Question::get();
        return redirect('/',compact('time','question'));
    }
    public function indextest(Request $request){

        if(request()->session()->has('time') && request()->session()->has('questions')){
            session(['finished' => true]);
            return view('finish', ['last' => request()->session()->get("questions"), 'request' => $request]);
        }else{
            return redirect('/');
        }

    }
}
