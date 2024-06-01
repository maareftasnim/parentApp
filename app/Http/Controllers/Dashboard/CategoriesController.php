<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    public function create(){
        $userId=Auth::guard('teachers')->user();
        $id= $userId->id;
        $coursId=DB::table('teacher_classe')->where('teachers_id',$id)->pluck('classe_id');
        foreach ($coursId as $cour){
            $data=json_decode($cour,true);
        }
        $class=DB::table('classe')->whereIn('id',$data)->pluck('title','id');
        return view('Quiz.Categories.ajoute',compact('class','id'))->withTitle('create categories');
    }
    public function index(){
        $categories=Categories::get();
        return view ('Quiz.Categories.index',compact('categories'))->withTitle('liste des categories');
    }
    public function store(Request $request){
        $category=Categories::create($request->all());
        return redirect()->back()->with('success','categorie added');
    }
    public function edit($id){
        $categories=Categories::find($id);
        $userId=Auth::guard('teachers')->user();
        $iduser= $userId->id;
        $coursId=DB::table('teacher_classe')->where('teachers_id',$id)->pluck('classe_id');
        foreach ($coursId as $cour){
            $data=json_decode($cour,true);
        }
        $class=DB::table('classe')->whereIn('id',$data)->pluck('title','id');
        return view('Quiz.Categories.edit',compact('categories','iduser','class'))->withTitle('edite categories');
    }
    public function update(Request $request,$id)
    {
        try {
            $categories=Categories::find($id);
            $categories->update($request->all());
            return redirect()->back()->with('sucess','categorie updated');
        }catch (\Exception $e)
        {
            return  $e->getMessage();
        }

    }
    public function destroy($id){

    }
}
