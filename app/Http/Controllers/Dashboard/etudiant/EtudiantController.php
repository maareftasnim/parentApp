<?php


namespace App\Http\Controllers\Dashboard\etudiant;


use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\Matier;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:parents')->except(['updateparents', 'editparents']);
    }

    public function showTravail($id)
    {
        $etudiant=Etudiant::find($id);
        $travailId=DB::table('travail_etudiant')->where('etudiant_id',$etudiant->id)->pluck('travail_id');
        $travail=DB::table('travail')->whereIn('id',$travailId)->get();
        $travail->each(function ($cour) {
            $cour->documents = explode(',', $cour->document);
        });
        return view('travail-a-faire.showEtudiant',compact('etudiant','travail'));
    }
    public function showCours($id)
    {
        $class=Classe::find($id);
        $cours=Cours::where('class_id',$class->id)->get();
        $matiers = Matier::all();

        $cours->each(function ($cour) {
            $cour->documents = explode(',', $cour->document);
        });
        return view('Cours.show',compact('class','cours','matiers'));
    }
    public function showConvocation($id)
    {
        $etudiant=Etudiant::find($id);
        $convocationId=DB::table('conv_etud')->where('etudiant_id',$etudiant->id)->pluck('convocation_id');
        // dd($convocationId);


        $convocations=DB::table('convocations')->whereIn('id',$convocationId)->get();
        //$convocations=Convocation::where('id',$conv->convocation_id)->get();


        return view('Convocation.showEtudiant',compact('etudiant','convocations'));
    }
    public function editparents($id)
    {
       $etudiant= Etudiant::find($id);
       return view('Parent.etudiantedit',compact('etudiant'))->withTitle('edite enfants');
    }
    public function updateparents(Request $request, $id){
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'date_naissance'=>'required',
            'class_id'=>'exists:classe,id',
            'niveau_id'=>'exists:niveau,id',
            'avatar'=>'',
        ]);

        $etudiant = Etudiant::find($id);
        $etudiantData = $request->except('avatar');


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('avatars');
            $file->move($destinationPath, $avatarName);

            if ($etudiant->avatar) {
                $oldAvatarPath = public_path($etudiant->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            $etudiantData['avatar'] = 'avatars/' . $avatarName;
        }

        $etudiant->update($etudiantData);

        return redirect()->back()->with('success', 'Etudiant updated successfully');
    }





    public function show($id)
  {
          $etudiant = Etudiant::find($id);
          $classe=Classe::get();
          $niveaux=Niveau::all();
          if (!$etudiant)
              return view('404');
          return view('etudiant.liste', compact('etudiant','niveaux','classe'));


  }
  public function edit($id){

          $etudiant = Etudiant::find($id);
          if (!$etudiant)
              return view('404');
          return view('etudiant.update', compact('etudiant'));


  }

    public function create(){
            $parents=Auth::guard('parents')->user()->id;
            return view ('etudiant.ajouter',compact('parents'));

    }
    public function store(Request $request){

             //dd($request->all());
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'date_naissance' => 'required',
                'class_id' => 'exists:classe,id',
                'niveau_id' => 'exists:niveau,id',
                'parent_id' => 'exists:parents,id',
                ]);

            $etudiant = new Etudiant($request->all());
            //dd($etudiant);
        $etudiant->status = 1;
            $etudiant->save();
            //return response()->json($etudiant);

            return redirect()->back()->with('success', 'Etudiant créé avec succès');

    }
   public function classe($id){
    $classes = Classe::where('niveau_id', $id)->get();
   }

}
