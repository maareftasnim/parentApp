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
            $moduleid = Matier::pluck('module_id');

            $module = Module::whereIn('id', $moduleid)->get();

            $etudiantId = Etudiant::find($id);
            $matiers = Matier::get();
            $classes = Classe::all();
            $classEtudiant = Classe::where('id', $etudiantId->class_id)->first();
            $information = Ecole::all();
            $notes = DB::table('etudiant_notes')
                ->where('etudiant_id', $id)
                ->where('semester_id', $semestre_id)
                ->get();

            $totalWeightedScore = 0;
            $totalSubjects = count($notes);

            // Initialize an array to store the maximum note for each subject
            $maxNotes = [];

            foreach ($matiers as $matier) {
                $matierMaxNote = DB::table('etudiant_notes')
                    ->where('semester_id', $semester->id)
                    ->where('class_id', $etudiantId->class_id)
                    ->where('matier_id', $matier->id)
                    ->max('note');


                $maxNotes[$matier->id] = $matierMaxNote;
            }
            foreach ($matiers as $matier) {
                $matierMinNote = DB::table('etudiant_notes')
                    ->where('semester_id', $semester->id)
                    ->where('class_id', $etudiantId->class_id)
                    ->where('matier_id', $matier->id)
                    ->min('note');


                $minNotes[$matier->id] = $matierMinNote;
            }

            foreach ($notes as $note) {
                $matier = Matier::find($note->matier_id);
                $totalWeightedScore += $note->note * $matier->coef;
            }

            $averageNote = $totalSubjects > 0 ? $totalWeightedScore / $totalSubjects : 0;
            $maxmoyenne=DB::table('moyennes')->where('semestre_id',$semester->id)->where('classe_id',$etudiantId->class_id)->max('moyenne');

            return view('bulletin', compact('classEtudiant', 'information', 'notes', 'etudiantId', 'matiers', 'classes', 'averageNote', 'module', 'semestre_id', 'maxNotes','maxmoyenne','minNotes'));
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
