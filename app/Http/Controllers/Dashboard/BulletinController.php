<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Ecole;
use App\Models\Etudiant;
use App\Models\Matier;
use App\Models\Module;
use App\Models\Moyenne;
use App\Models\Trimester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BulletinController extends Controller
{
    public function index($id, Request $request, $semestre_id)
    {
        $semester = Trimester::find($semestre_id);
        if ($semester && $semester->status == 1) {
        $moduleid=Matier::get('module_id');

        $module=Module::whereIn('id',$moduleid)->get();

        $etudiantId = Etudiant::find($id);
        $matiers = Matier::get();
        //$types = Typenote::all();
        $classes = Classe::all();
        $classEtudiant=Classe::where('id',$etudiantId->class_id)->get()->first();
        $information=Ecole::all();
        $notes = DB::table('etudiant_notes')->where('etudiant_id', $id)->where('semester_id',$semestre_id)->get();


        $totalWeightedScore = 0;
        $totalSubjects = count($notes);

        foreach ($notes as $note) {
            $matier = Matier::find($note->matier_id);
            $totalWeightedScore += $note->note * $matier->coef;
        }

        $averageNote = $totalSubjects > 0 ? $totalWeightedScore / $totalSubjects : 0;

        return view('bulletin', compact('classEtudiant','information','notes', 'etudiantId', 'matiers',  'classes', 'averageNote','module','semestre_id'));
        //return view('bulletin',compact('module','matier','notes', 'etudiantId',  'classes', 'averageNote'));
        } else {
            return 'no_bulletin_available';
        }
        }

    public function table()
    {
        $semestre=Trimester::all();
        return view('publierBulletin',compact('semestre'));
    }
    public function changeStatus($id){

        try{

            $semestre=Trimester::find($id);

            $etat= $semestre->status == 0 ? 1 :0 ;
            $semestre->update(['status'=> $etat]);

            return redirect()->route('bulletin.changeStatus')->with(['success'=>'updated successfully']);

        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
//    public function withoutclasse()
//    {
//        dd('$etudiantWithoutClasse');
//        $etudiantWithoutClasse=Etudiant::whereNotNull('deleted_at')->get();
//
//        return $etudiantWithoutClasse;
//    }


}
