<?php

namespace App\Http\Livewire;

use App\Http\Requests\ParentRequest;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Traits\ImageTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class Wizard extends Component
{
    use MustVerifyEmailTrait;
    use RegistersUsers;
    use ImageTrait;
    use WithFileUploads;
    public $currentStep = 1;
    public $confirme_password,$nomP, $prenomP, $numtelP, $metierP , $status = 0 ,$nomM, $prenomM, $numtelM, $metierM , $numtelS ,$numtelF ,$email  ,$password;
    public $nom,$prenom,$niveau_id,$date_naissance,$parents,$avatar;
    public $successMessage = '';
    public $errorMissage='';
    var $etudiantscol=[];


    public function collectetudiant(){
        $this->etudiantscol=collect();
    }
//    public function rules(){
//        return [
//            'etudiantscol' => 'required|min:1',
//
//            'etudiantscol.*.nom'=>'requirerd',
//            'etudiantscol.*.prenom'=>'requirerd',
//            'etudiantscol.*.date_naissance'=>'requirerd',
//            'etudiantscol.*.niveau_id'=> 'requirerd',
//            'etudiantscol.*.avatar'=> 'image|max:1024'
//
//        ];
//    }

    public function addEtudiant(){
        $this->validate([
            'etudiantscol.*.nom' => 'required',
            'etudiantscol.*.prenom' => 'required',
            'etudiantscol.*.date_naissance' => 'required',
            'etudiantscol.*.niveau_id' => 'required',
            'etudiantscol.*.avatar'=> 'image|max:1024'
        ]);

        $newEtudiant = [
            'nom' => $this->nom,
            'date_naissance' => $this->date_naissance,
            'prenom' => $this->prenom,
            'niveau_id' => $this->niveau_id,
            'avatar'=> $this->avatar
        ];

        $this->etudiantscol[] = $newEtudiant;


        $this->nom = '';
        $this->date_naissance = '';
        $this->prenom = '';
        $this->niveau_id = '';

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
    public function firstStepSubmit(Request $request)
    {

        $this->validate([
            'nomP' => 'required|max:20|alpha|bail',
            'prenomP' => 'required|max:20|alpha|bail',
            'numtelP' => 'required|numeric',
            'metierP'=>'required|max:50|alpha|bail',
            'nomM' => 'required|max:20|alpha|bail',
            'prenomM' => 'required|max:20|alpha|bail',
            'numtelM' => 'required|numeric',
            'metierM'=>'required|max:50|alpha|bail',
            'numtelS'=>'required|numeric',
            'numtelF'=>'required|numeric',
            'email' => "required|string|email|max:255|unique:parents,email",
            'password' => 'required|string|min:8',
            'confirme_password'=>'required_with:password|same:password|min:8'

        ],[
            'nomP.required' => 'le champs et obligatoire',
            'nomP.bail' => 'le champs contient des alphabet setout',
            'nomP.max' => 'le champs max 20 caractère',
            'prenomP.required' => 'le champs et obligatoire',
            'prenomP.max' => 'le champs max 20 caractère',
            'prenomP.bail' => 'le champs contient des alphabet setout',
            'numtelP.required' => 'le champs et obligatoire',
            'numtelP.numeric' => 'le champs doit etre numeric ',
            'metierP.required'=>'le champs et obligatoire',
            'metierP.max'=>'le champs max 50 caractère',

            'nomM.required' => 'le champs et obligatoire',
            'nomM.bail' => 'le champs contient des alphabet setout',
            'nomM.max' => 'le champs max 20 caractère',
            'prenomM.required' => 'le champs et obligatoire',
            'prenomM.max' => 'le champs max 20 caractère',
            'prenomM.bail' => 'le champs contient des alphabet setout',
            'numtelM.required' => 'le champs et obligatoire',
            'numtelM.numeric' => 'le champs doit etre numeric ',
            'metierM.required'=>'le champs et obligatoire',
            'metierM.max'=>'le champs max 50 caractère',

            'numtelS.numeric' => 'le champs doit etre numeric ',
            'numtelF.numeric' => 'le champs doit etre numeric ',
            'email.required' => 'le champs et obligatoire',
            'email.unique' => 'this email is already takin',
            'password.required' => 'le champs et obligatoire',
            'password.min' => 'min 8 et obligatoire',
            'confirme_password.required'=>'le champs et obligatoire',
            'confirme_password.same'=>'password dosn\'t much',

        ]);

        //dd($validatedData );
        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected function rules()
    {
        $rules = [];

        foreach ($this->etudiantscol as $key => $etudiant) {
            $rules["etudiantscol.{$key}.nom"] = 'required|max:20|alpha';
            $rules["etudiantscol.{$key}.prenom"] = 'required|max:20|alpha';
            $rules["etudiantscol.{$key}.date_naissance"] = 'required';
            $rules["etudiantscol.{$key}.niveau_id"] = 'required';
            $rules["etudiantscol.{$key}.avatar"] = 'image|max:1024';
        }

        return $rules;
    }
    protected function messages()
    {
        $messages = [];

        foreach ($this->etudiantscol as $key => $etudiant) {
            $messages["etudiantscol.{$key}.nom.required"] = 'The nom field is required.';
            $messages["etudiantscol.{$key}.nom.max"] = 'The nom field must not be greater than 20 characters.';
            $messages["etudiantscol.{$key}.nom.alpha"] = 'The nom field must contain only alphabetic characters.';
            $messages["etudiantscol.{$key}.prenom.required"] = 'The prenom field is required.';
            $messages["etudiantscol.{$key}.prenom.max"] = 'The prenom field must not be greater than 20 characters.';
            $messages["etudiantscol.{$key}.prenom.alpha"] = 'The prenom field must contain only alphabetic characters.';
            $messages["etudiantscol.{$key}.date_naissance.required"] = 'The date_naissance field is required.';
            $messages["etudiantscol.{$key}.niveau_id.required"] = 'The niveau_id field is required.';
            $messages["etudiantscol.{$key}.avatar.image"] = 'The avatar must be an image.';
            $messages["etudiantscol.{$key}.avatar.max"] = 'The avatar size must not exceed 1024 kilobytes.';
        }

        return $messages;
    }
    public function secondStepSubmit()
    {
        try {
            $this->validate();

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


        try {
            DB::beginTransaction();
            $parent = Parents::create([
                'nomP' => $this->nomP,
                'prenomP' => $this->prenomP,
                'numtelP' => $this->numtelP,
                'metierP' => $this->metierP,
                'nomM' => $this->nomM,
                'prenomM' => $this->prenomM,
                'numtelM' => $this->numtelM,
                'metierM' => $this->metierM,
                'numtelS' => $this->numtelS,
                'numtelF' => $this->numtelF,
                'email' => $this->email,
                'password' =>Hash::make( $this->password),
                'status'=>$this->status,
            ]);
            foreach ($this->etudiantscol as $etudiantData) {
                $file = $etudiantData['avatar'];
                if ($file) {
                    $avatarName = time();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $avatarName . '.' . $extension;
                    $destinationPath = public_path('avatars');
                    $path = $file->storeAs('avatars', $fileName, 'public');
                    $etudiantData['avatar'] = $path;
                }

                $parent->enfants()->create([
                    'nom' => $etudiantData['nom'],
                    'prenom' => $etudiantData['prenom'],
                    'date_naissance' => $etudiantData['date_naissance'],
                    'niveau_id' => $etudiantData['niveau_id'],
                    'avatar' => $etudiantData['avatar'],
                ]);

            }

            DB::commit();

            $parent->sendEmailVerificationNotification();

            //dd($parent);
            //return redirect('/')->with('success', 'Registration successful. Please check your email for verification.');
            $this->successMessage = 'Registration successful. Please check your email for verification.';
            $this->clearForm();

            // $this->currentStep = 1 ;

        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e);
            $this->addError('validation_error', $e->getMessage());
            //dd($e->getMessage());


        }


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
        $this->metierP='';
        $this->nomM='';
        $this->prenomM='';
        $this->numtelM='';
        $this->metierM='';
        $this->numtelS='';
        $this->numtelF='';
        $this->password='';
        $this->email='';

    }


}
