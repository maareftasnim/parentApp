<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;

class MatierRequest extends FormRequest
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
            "matiername"=>"required|min:3|max:25|bail",
            "coef"=>"required|numeric",
            //"type_id"=>"required|array",
            "module_id"=>"required",
            "niveau_id"=>"required"
        ];
    }

    public function messages(){
        return[
          "matiername.required"=>"le nom de matier est obligatoire",
            "module_id.required"=>"le nom de module est obligatoire",
            "niveau_id.required"=>"le nom de niveau est obligatoire",

            //"type_id.required"=>"le nom de type est obligatoire",
          "coef.required"=>"le champ de coefition est obligatoire",
          "matiername.min"=>"le minimum est 3 caractaires",
          "matiername.max"=>"le maximum est 25 caractaires",
           "coef.numeric"=>"le must be numeric",

        ];
    }
}
