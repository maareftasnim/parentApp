<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatierRequest;
use App\Models\Matier;
use App\Models\Module;
use App\Models\Niveau;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Nette\Schema\ValidationException;

class MatierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,teachers');

    }
    public function  index(){
        $chechPerms =  $this->checkUserPermissionforAdmin('show-matier','admin','teachers');
        if($chechPerms) {
            $niveaux=Niveau::all();
            $matierID=Matier::get();
            $matiers=Matier::all();
            $matier=$matierID->unique()->values()->all();
            $modules=Module::get();
            //$types=Typenote::all();
//            foreach ($matiers as $id) {
//                $typeId = DB::table('matier_typnote')->whereIn('matier_id', $id)->pluck('type_id');
//            }
//
            //$types=DB::table('typenote')->whereIn('id',$typeId)->pluck('title','id');
//
//            if (!$types)
//                echo 'you must create tyo note ';
            return view('Matiers.listeMatier',compact('matier','niveaux','modules'))->withTitle('ajouter matiers');

        }
        return abort(404);
    }

    public function create(){
        $chechPerms =  $this->checkUserPermissionforAdmin('create-matier','admin','teachers');
        if($chechPerms) {
            $modules=Module::all();
            //$types=Typenote::all();
            return view('Matiers.AddMatier',compact('modules'))->withtitle('add Matier');
        }
        return abort(404);
    }
//    public  function edit($id){
//        $chechPerms =  $this->checkUserPermissionforAdmin('update-matier','admin','teachers');
//        if($chechPerms) {
//            $matiers=Matier::find($id);
//            if (!$matiers)
//                return view('404');
//            $niveau=Niveau::all();
//            $modules=Module::get();
//           // $types=Typenote::all();
//            return view('Matiers.MatierUpdate',compact('matiers','niveau','types','modules'));
//
//        }
//        return abort(404);
//
//    }
    public function update(MatierRequest $request, $id)
    {
        $chechPerms =  $this->checkUserPermissionforAdmin('update-matier','admin','teachers');
        if($chechPerms) {
            try {
                $matier = Matier::find($id);

                if (!$matier) {
                    return view('404');
                }

                $matier->update([
                    'matiername' => $request->input('matiername'),
                    'coef' => $request->input('coef'),
                    'niveau_id' => $request->input('niveau_id'),
                    'module_id' => $request->input('module_id'),
                ]);

                $matier->types()->sync($request->get('type_id'));

                return redirect()->back()->with('success', 'Matier updated successfully');
            } catch (ValidationException $e) {
                return view('404');
            }
        }
        return abort(404);

    }
    public function store(MatierRequest $request)
    {
        $chechPerms =  $this->checkUserPermissionforAdmin('create-matier','admin','teachers');
        if($chechPerms) {
            try {
                $matier = new Matier();
                $matier->matiername = $request->input('matiername');
                $matier->coef = $request->input('coef');
                $matier->niveau_id = $request->input('niveau_id');
                $matier->module_id = $request->input('module_id');
                $matier->save();
//                if (!$matier) {
//                    return view('404');
//                }


                //$matier->types()->sync($request->get('type_id'));


                return back()->with('success', ' matier have been created successfully.');
            } catch (Exception $e) {
                return  $e->getMessage();
                //return view('404');
            }
        }
        return abort(404);

    }

    public function delete($id){
        $chechPerms =  $this->checkUserPermissionforAdmin('delete-matier','admin','teachers');
        if($chechPerms) {
            $matier = Matier::find($id);
            $matier->delete();
            return redirect()->route('matiers.index')
                ->with('success', 'matier deleted successfully');
        }
        return abort(404);

    }
}
