<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NiveauRequest extends FormRequest
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
            "niveauNom"=>"required|max:255|unique:niveau,niveauNom,' . $this->id",
//            'matier_id'=>'required|array',
        ];
    }
    public function messages(){
        return[
            'niveauNom.required'=>"champ niveau est obligatoire",
            'niveauNom.unique'=>"The niveau nom has already been taken",
            //'matier_id.required'=>"matier est obligatoire",
        ];
    }
}
