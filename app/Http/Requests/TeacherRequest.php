<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            "firstname"=>"required|min:3|max:12|alpha|bail",
            "lastname"=>"required|min:3|max:12|alpha|bail",
            "email"=>"required|email|unique:teachers,email,".$this->id,
            "phoneNumber"=>'required|min:8|numeric|unique:teachers,phoneNumber,'.$this->id,
            "password"=>"required|min:8",
            "class_id"=>"required|array"
        ];
    }
    public function messages(){
        return[
            "firstname.required"=>"le champ first name est obligatoire.",
            "lastename.required"=>"le champ last name est obligatoire.",
            "email.required"=>"le champ email  est obligatoire.",
            "phoneNumber.required"=>"le champ phone number  est obligatoire.",
            "password.required"=>"le champ password  est obligatoire.",
            "niveau_id.required"=>"le champ niveau_id est obligatoire .",
            "classe_id.required"=>"le champ classe_id est obligatoire .",
            "email.email"=>"ce champ email doit etre une adress-email valide",
            "password.min"=>"ce champ doit etre minimum:min caracteres",
            "phoneNumber.min"=>"ce champ doit etre minimum:min caracteres",
            "lastname.min"=>"ce champ doit etre minimum:min caracteres",
            "firstname.min"=>"ce champ doit etre minimum:min caracteres",
            "phoneNumber.max"=>"ce champ doit etre maximum:max caracteres",
            "lastname.max"=>"ce champ doit etre maximum:max caracteres",
            "firstname.max"=>"ce champ doit etre maximum:max caracteres",
            "email.unique"=>"le email deja existe",
            "phoneNumber.numeric"=>"ce champ doit etre numeric",

        ];
    }
}
