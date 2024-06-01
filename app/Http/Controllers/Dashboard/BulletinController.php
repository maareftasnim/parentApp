<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Matier;
use App\Models\Module;
use App\Models\Trimester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BulletinController extends Controller
{
    public function index($id, Request $request, $semestre_id)
    {
        $semester = Trimester::find($semestre_id);

        if ($semester && $semester->status == 1) {
            // Fetch required data
            $module = Module::get();
            $semestres = Trimester::all();
            $etudiantId = Etudiant::find($id);
            $matiers = Matier::get();
            $classes = Classe::all();
            $notes = DB::table('etudiant_notes')->where('etudiant_id', $id)->where('semester_id', $semestre_id)->get();

            $totalWeightedScore = 0;
            $totalSubjects = count($notes);
            foreach ($notes as $note) {
                $matier = Matier::find($note->matier_id);
                $totalWeightedScore += $note->note * $matier->coef;
            }
            $averageNote = $totalSubjects > 0 ? $totalWeightedScore / $totalSubjects : 0;

            return view('bulletin', compact('notes', 'etudiantId', 'matiers', 'classes', 'averageNote', 'module', 'semestre_id', 'semestres'));
        } else {
            return 'no bulletin available';
        }
    }

}
