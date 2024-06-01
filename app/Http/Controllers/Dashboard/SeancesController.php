<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Days;
use App\Models\Salle;
use App\Models\Seances;
use App\Models\Teachers;
use App\Services\CalendarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class SeancesController extends Controller
{
//    public function __construct()
//    {
//        //$this->middleware('auth:parents')->except(['SalleComplet','TeacherComplet','matier_teacher']);
//
//    }
    public function index(){

            $days=DB::table('days')->get();
            //$calendarData=$calendarService->generateCalendarData($days);
            return view('Emplois.emploi',compact('days'));

        //return abort(404);
    }

    public function store(Request $request){

            try {
                $validatedData = $request->validate([
                    'matier_id' => 'required',
                    'teacher_id' => 'required',
                    'salle_id'=>'required',
                    'day_id'=>[
                        'required',
                        'integer',
                        'min:1',
                        'max:7'],
                    'class_id'=>'required',
                    'start_time'=> [
                        'required',
                        'date_format:' . config('panel.lesson_time_format')],
                    'end_time'=> [
                        'required',
                        'after:start_time',
                        'date_format:' . config('panel.lesson_time_format')],
                    'emploi_id' => 'required'
                ]);


                $lesson = new Seances($request->all());
                $salleComplet = $this->SalleComplet($request->input('salle_id'));

                foreach ($salleComplet as $reserved) {

                    if ($reserved->day_id == $request->input('day_id') && $reserved->start_time == $request->input('start_time')   ) {
                        //return redirect()->back()->with('error','la salle est deja reserver ');
                        return response()->json(['message' => 'La salle est déjà réservée.'], 422);
//                    }elseif($request->input('start_time') < $reserved->end_time){
//                        return response()->json(['message' => 'La salle est déjà réservée.'], 422);
                    }

                }
                $TeacherComplet = $this->TeacherComplet($request->input('teacher_id'));

                foreach ($TeacherComplet as $reservedclasse) {

                    if ($reservedclasse->day_id == $request->input('day_id') && $reservedclasse->start_time == $request->input('start_time')   ) {
                        //return redirect()->back()->with('error','la salle est deja reserver ');
                        return response()->json(['message' => 'teacher est déjà réservée.'], 422);
//                    }elseif($request->input('start_time') < $reserved->end_time){
//                        return response()->json(['message' => 'teacher est déjà réservée.'], 422);
                    }

                }

                $lesson->save();
            } catch (ValidationException $e){
                return view('404');
            }

        // return abort(404);

    }





    public function class_teacher(Request $request){
        $teacher=DB::table('teacher_matier')->where('class_id',$request->input('class_id'))->pluck('teacher_id');
        return $data=DB::table('teachers')->whereIn('id',$teacher)->pluck('firstname','id');
    }
    public function matier_teacher(Request $request){

        $matierId=DB::table('teacher_matier')->where('class_id',$request->input('class_id'))->where('teacher_id',$request->input('teacher_id'))->pluck('matier_id');

        foreach ($matierId as $matier){

            $data=json_decode($matier,true);
        }

        return $matiername=DB::table('matiers')->whereIn('id',$data)->pluck('matiername','id');
    }
    public function delete($id)
    {
            $seance = Seances::find($id);
            if ($seance) {
                $seance->delete();}

        // return abort(404);

    }

    public function SalleComplet($id){
        $days=DB::table('days')->get();
        $salle=Salle::find($id);
        return $salleComplet=Seances::where('salle_id',$id)->get(['day_id','start_time','end_time']);

        //return response()->json(['success' => true, 'data' => $salleComplet], 200);
        //return view('salle.emploi',compact('salleComplet','days','salle'));
    }
    public function TeacherComplet($id){
        $days=DB::table('days')->get();
        $salle=Teachers::find($id);
        return $salleComplet=Seances::where('teacher_id',$id)->get(['day_id','start_time','end_time']);

        //return response()->json(['success' => true, 'data' => $salleComplet], 200);
        //return view('salle.emploi',compact('salleComplet','days','salle'));
    }
}
