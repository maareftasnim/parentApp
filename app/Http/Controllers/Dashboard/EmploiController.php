<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Days;
use App\Models\Emploi;
use App\Models\Salle;
use App\Models\Seances;
use App\Models\Teachers;
use App\Services\CalendarService;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class EmploiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:parents')->except(['showEmploi']);

    }
    public function delete($id){
        $chechPerms =  $this->checkUserPermissionforAdmin('delete-emploi','admin','teachers');
        if($chechPerms) {
            $emploi=Emploi::find($id);
            $emploi->seances()->delete();
            $emploi->delete();
            return redirect()->back()->with('success','emploi deleted seccessfuly');
        }
        return abort(500);
    }
    public function store(Request $request){

        $chechPerms =  $this->checkUserPermissionforAdmin('create-emploi','admin','teachers');
        if($chechPerms) {
            $request->validate([
                'name' => 'required|string|max:255',
                'class_id'=>'required|unique:emploi'
            ]);
            try {


                $emploi = new Emploi();
                $emploi->name = $request->name;
                $emploi->class_id = $request->class_id;
                $emploi->save();
                $days=Days::all();
                $calendarService = new CalendarService();
                $calendarData=$calendarService->miseAjourCalendarData($days);

                return view('Emplois.emploi',compact('days','calendarData','emploi'));


            }catch (ValidationException $e){
                return('404');
            }
        }
        return abort(404);
    }

    public function create(){
        $chechPerms =  $this->checkUserPermissionforAdmin('create-emploi','admin','teachers');
        if($chechPerms) {
            $classe=Classe::all();
            $emploi=Emploi::all();
            return view('Emplois.addEmploi',compact('classe','emploi'));
        }
        return abort(404);

    }

    public function edite(CalendarService $calendarService, $id,Request $request){

        $chechPerms =  $this->checkUserPermissionforAdmin('update-emploi','admin','teachers');
        if($chechPerms) {

            $teacher=Teachers::all();
            $salle=Salle::all();
            $days=Days::all();
            $calendarData=$calendarService->generateCalendarData($days,$id);
            $emploi=Emploi::find($id);
            $seance=Seances::find($request->id);
            if (!$emploi){
                return view('404');
            }
            $classe=Classe::all();

            return view('Emplois.emploi',compact('teacher','salle','days','classe','calendarData','emploi','seance'));


        }
    }

    public function showEmploi(CalendarService $calendarService,$id,Request $request)
    {

        $classe =Classe::find($id);
        $teacher=Teachers::all();
        $salle=Salle::all();
        $days=Days::all();
        $calendarData=$calendarService->generateCalendarData($days,$id);
        //dd($calendarData);
        $emploi=Emploi::where('class_id',$classe->id)->get();
        $seance=Seances::find($request->id);
        if (!$emploi){
            return view('404');
        }

        return view('Emplois.show',compact('teacher','salle','days','classe','calendarData','emploi','seance'))->withTitle('show emploi');
    }

}
