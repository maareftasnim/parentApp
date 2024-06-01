<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtudiantNoteRequest extends FormRequest
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
           'note'=>'required|min:0|max:20',
            'matier_id'=>'required|exists:matiers',
            'etudiant_id'=>'required|exists:etudiants'
        ];
    }
    public function message()
    {
        return [
            'note.min'=>'note doit étre superieur a zero',
            'note.max'=>'note doit etre inferieur a 20',
            'note.required'=>'champs note obligatoire',
            'matier_id.required'=>'champs matier obligatoire',
            'etudiant_id.required'=>'champs etudiant obligatoire'
        ];
    }
}
