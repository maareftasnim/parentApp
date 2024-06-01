<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:parents,email,'.$this->id,
            'password' => 'required|string|min:8',
            'confirme_password'=>'required_with:password|same:password|min:8'

        ];
    }
    public function messages()
    {
        return[
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
            'email.unique' => 'le champs et obligatoire',
            'password.required' => 'le champs et obligatoire',
            'password.min' => 'min 8 et obligatoire',
            'confirme_password.required'=>'le champs et obligatoire',
           'confirme_password.same'=>'password dosn\'t much',

        ];

    }
}
