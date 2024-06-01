<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Parents;

class originalWizard extends Component
{
    public $currentStep = 1;
    public $nomP, $prenomP, $numtelP, $metierP , $cidP ,$etatP,$nomM, $prenomM, $numtelM, $metierM , $cidM ,$etatM ,$numtelS ,$numtelF ,$email  ,$password,$confirmepassword;
    public $nom,$prenom,$niveau_id,$date_naissance,$parent_id,$parents;
    public $successMessage = '';
    var $etudiantscol=array([]);
    var $countetudiant= 1;

    /*public function collectetudiant(){
        $this->etudiantscol=collect();
    }*/
    public function rules(){
        return [
            'etudiantscol' => 'required|min=1',

            'etudiantscol.*.nom'=>'requirerd',
            'etudiantscol.*.prenom'=>'requirerd',
            'etudiantscol.*.date_naissance'=>'requirerd',
            'etudiantscol.*.niveau_id'=> 'requirerd',

        ];
    }

    public function addEtudiant(){

        //$this->etudiantscol=new Collection();
        $validatedData = $this->validate([
            'nom' => 'required',
            'date_naissance' => 'required',
            'prenom' => 'required',
            //'niveau_id' => 'exists:niveau,id',

        ]);
        $this->etudiantscol->push($this->validate([
            'nom' => $this->nom,
            'date_naissance' => $this->date_naissance,
            'prenom' => $this->prenom,
            //'niveau_id' => 'exists:niveau,id',

        ]));


        dd($this->etudiantscol);
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.wizard');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'nomP' => 'required',
            'prenomP' => 'required',
            'numtelP' => 'required|numeric',
            'cidP' => 'required|numeric',
            'etatP' => 'required',
            'metierP'=>'required',

            'nomM' => 'required',
            'prenomM' => 'required',
            'numtelM' => 'required|numeric',
            'cidM' => 'required|numeric',
            'etatM' => 'required',
            'metierM'=>'required',

            'numtelS'=>'required|numeric',
            'numtelF'=>'required|numeric',

            'email' => ['required', 'string', 'email', 'max:255', 'unique:parents'],
            'password' => ['required', 'string', 'min:8'],

        ]);

        //dd($validatedData );
        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {



        try {
            $validationRules = [
                'etudiantscol.*.nom' => 'required',
                'etudiantscol.*.prenom' => 'required',
                'etudiantscol.*.date_naissance' => 'required',
               // 'etudiantscol.*.niveau_id' => 'required',
            ];

            $validatedData = $this->validate($validationRules);

            $this->etudiantscol = collect($validatedData['etudiantscol']);

            $this->currentStep = 3;
        } catch (ValidationException $e) {
            $this->addError('validation_error', $e->getMessage());
        }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {


        $parent = Parents::create([
            'nomP' => $this->nomP,
            'prenomP' => $this->prenomP,
            'numtelP' => $this->numtelP,
            'cidP' => $this->cidP,
            'metierP' => $this->metierP,
            'etatP' => $this->etatP,

            'nomM' => $this->nomM,
            'prenomM' => $this->prenomM,
            'numtelM' => $this->numtelM,
            'cidM' => $this->cidM,
            'metierM' => $this->metierM,
            'etatM' => $this->etatM,

            'numtelS'=>$this->numtelS,
            'numtelF'=>$this->numtelF,
            'email'=>$this->email,
            'password'=>$this->password,
        ]);
        //$parent=new Parents();
        /* Etudiant::create([
             'nom' => $this->nom,
             'prenom' => $this->prenom,
             'date_naissance' => $this->date_naissance,
             'niveau_id' => $this->niveau_id,
             'parent_id' => $parent->id,

         ]);
*/
        foreach ($this->etudiantscol as $etudiantData) {
            $etudiant = $parent->enfants()->create([
                'nom' => $etudiantData['nom'] ,
                'prenom' => $etudiantData['prenom'],
                'date_naissance' => $etudiantData['date_naissance'],
                //'niveau_id' => $etudiantData['niveau_id'],
                'parent_id' => $parent->id,
            ]);

            // $parent->enfants()->create($etudiantData);
        }


        $this->successMessage = 'parents Created Successfully.';
        //dd($this->nomP, $this->cidP, $this->email, $this->nomM, $this->numtelP);
        $this->clearForm();
        $this->currentStep = 1;


    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->nomP='';
        $this->prenomP='';
        $this->numtelP='';
        $this->cidP='';
        $this->metierP='';
        $this->etatP='';

        $this->nomM='';
        $this->prenomM='';
        $this->numtelM='';
        $this->cidM='';
        $this->metierM='';
        $this->etatM='';

        $this->numtelS='';
        $this->numtelF='';
        $this->password='';
        $this->email='';

    }
}
