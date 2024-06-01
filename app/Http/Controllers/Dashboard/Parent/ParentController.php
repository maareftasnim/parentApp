<?php



namespace App\Http\Controllers\Dashboard\Parent;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ParentRequest;

use App\Models\Classe;
use App\Models\Etudiant;

use App\Models\Niveau;
use App\Models\Parents;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class
ParentController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:parents')->except('login');

    }
    use RegistersUsers;
    var $etudiantscol=[];
    public function submitForm(Request $request)
    {
        try {
            $parent = Parents::create([
                'nomP' => $request->nomP,
                'prenomP' => $request->prenomP,
                'numtelP' => $request->numtelP,
                'metierP' => $request->metierP,
                'nomM' => $request->nomM,
                'prenomM' => $request->prenomM,
                'numtelM' => $request->numtelM,
                'metierM' => $request->metierM,
                'numtelS' => $request->numtelS,
                'numtelF' => $request->numtelF,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 0,
            ]);
            foreach ($request->etudiantscol as $etudiantData) {
                $file = $etudiantData['avatar'] ?? null;
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
                    'avatar' => $etudiantData['avatar'] ?? null,
                ]);
                \Log::debug('Creating enfant record:', $etudiantData);
            }

            DB::commit();

            $parent->sendEmailVerificationNotification();

            return response()->json(['message' => 'Form submitted successfully', 'code' => 200]);
        } catch (\Exception $e) {
            \Log::error('Error submitting form: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }


    //partie parent
    public function wizard(){

        return view('default');
    }
    public function update(ParentRequest $request, $id){
        try {
            $parents = Parents::find($id);
            $parents->update($request->validated());
        }catch (ValidationException $e) {

            return view('404');
        }
    }
    public function show($id)
    {
        $parents = Parents::find($id);
        $etudiants=Etudiant::where('parent_id',$id)->whereNull('deleted_at')->get();
        if(!$parents)
            return view('404');
        return view('Parent.showParents', compact('parents','etudiants'));
    }

    public function edit($id){
        $parents = Parents::find($id);
        return view('Parent.updateParents', compact('parents'));
    }
    public function verify(Request $request)
    {
        $parent = Parents::find($request->route('id'));

        if (! URL::hasValidSignature($request)) {
            session()->flash('errorMessage', 'Invalid verification link');
            return redirect()->route('wiazard');
        }

        if ($parent->hasVerifiedEmail()) {
            session()->flash('errorMessage', 'Email address already verified');
            return redirect()->route('wiazard');
        }

        $parent->markEmailAsVerified();

        session()->flash('successMessage', 'Email successfully verified');
        return redirect()->route('wiazard');
    }
    public function loginView(){
    return view('Parent.loginparent');
    }
    public function login(LoginRequest $request){
        $credential = $request->only(['email','password']);
        if (Auth::guard('parents')->attempt($credential)&& Auth::guard('parents')->user()->status==1){
            $userId = Auth::guard('parents')->user()->id;
            $status=Auth::guard('parents')->user()->status==1;
            //return response()->json(['message' => 'login successful', 'code' => 200, 'userId' => $userId, 'status' => $status]);
           return redirect()->back()->with('success','login ');
        } else {
            return redirect()->back()->with('fail','password ou email wrong ');
        }
    }
    public function getUserById($userId)
    {
        try {
            $user = Parents::findOrFail($userId);
            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }
    public function logout()
    {

        Auth::guard('parents')->logout();

        if(!Auth::guard('parents')->check()) {
            return view('Parent.loginparent');
        } else {
            return response()->json(['message' => 'logout failed'], 500);
        }
    }


}
