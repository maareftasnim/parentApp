<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
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
            'email'=>'required|email:rfc,dns|unique:parents,email',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password'
        ];
    }
}
