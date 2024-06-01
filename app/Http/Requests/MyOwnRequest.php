<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyOwnRequest extends FormRequest
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
            "title"  => "required|max:30|alpha|bail",
            "objet"  => "required|min:50|max:12|alpha|bail",
            "raison"  => "required|min:10|max:100|alpha|bail",


            //
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "le champ title est obligatoire. ",
            "objet.required" => "le champ objet est obligatoire. ",
            "raison.required"=>"le champ raison est obligatoire"
        ];
}}
