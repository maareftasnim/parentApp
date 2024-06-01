<?php

namespace App\Http\Requests ;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class TravailRequest extends FormRequest
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
            "remarque"  => "required|min:10|alpha|bail",
           'document'=>'mimetypes:doc,docx,PDF,pdf|required',
            //'document'=>'required',
            'etudiant_id'=>'required',
            'image'=>'mimes:jpg,jpeg,png',
            'video'=>'mimes:mp4|max:60000000 ',
            'lien'=>['regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/|vimeo\.com\/)(\S+)$/']
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "le champ title est obligatoire. ",
            "objet.required" => "le champ objet est obligatoire. ",
            "raison.required"=>"le champ raison est obligatoire",
            "document.required"=>"le champ raison est obligatoire",
            "title.max"=>"le maximum est 30 car",
            "video.max"=>"la taille maximal est 60 MO",
            "remarque.min"=>"le minimum est 10 carc",
            "lien.regex"=>"lien must be youtube or vimo"
        ];
}}
