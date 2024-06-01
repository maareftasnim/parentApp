<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomLoginController extends Controller
{
//    public function LoginAdmin(Request $request)
//    {
//
//        $rules = [
//            'identify' => 'required',
//            'password' => 'required'
//        ];
//        $messages = [
//            'identify.required' => __('Email is required field'),
//            'password.required' => __('Password is required field'),
//        ];
//
//        $validator = Validator::make($request->all(), $rules, $messages);
//
//        if ($validator->fails())
//            return redirect()->back()->withInput()->withErrors ($validator);
//
//        try {
//
//            $credentials = $request->only($this->username(), 'password');
//
//            $credential = Auth::guard('admin')->attempt($credentials);
//
//            //$credential = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
//
//            if($credential){
//                return redirect()->intended('/admin/dashboard');
//                //return redirect()->intended('/home');
//            }else{
//                return redirect()->back()->with('error','L\'email et le mot de passe sont incorrects.');
//                //return back()->withInput($request->only('email', 'remember'));
//            }
//
//        }catch (\Exception $ex){
//            return $ex->getMessage();
//        }
//    }
    public function index()
    {
        return view('login.login')->withtitle('login');
    }
    public function username()
    {
        $login = request()->input('identify');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'firstname';
        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
   public function LoginTeacher(Request $request)
   {
       $rules = [
           'identify' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'identify.required' => 'Email is required field',
           'password.required' => 'Password is required field',
        ];

       $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors ($validator);
       try {


           $credential=$request->only($this->username(),'password');

           if (Auth::guard('teachers')->attempt($credential)){
               return redirect()->intended('teacher/dashboard');
           }else{
               return back()->withInput()->with('error', 'Invalid login format. Please use your email or a valid name.');
           }

       } catch (\Exception $e){
           return $e->getMessage();
       }
   }

   public function LoginAdmin(Request $request)
   {
       $rules = [
           'identify' => 'required',
           'password' => 'required'
       ];
       $messages = [
           'identify.required' => 'Email is required field',
           'password.required' => 'Password is required field',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails())
           return redirect()->back()->withInput()->withErrors ($validator);

       try {


           $credential=$request->only($this->username(),'password');
            //dd($this->username());
           if (Auth::guard('admin')->attempt($credential)){
               return redirect()->intended('admin/dashboard');
           }else{
               return back()->withInput()->with('error', 'Invalid login format. Please use your email or a valid name.');
           }

       } catch (\Exception $e){
           return $e->getMessage();
       }
   }
    function logoutTeacher()
    {
        Auth::guard('teachers')->logout();
        return redirect('');
    }
    function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('');
    }
}
