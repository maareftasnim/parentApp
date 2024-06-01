<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            'title' => 'required|max:255|unique:classe,title,' . $this->id,
            'niveau_id' => 'required|exists:niveau,id',
        ];
    }
    public function messages(){
        return[
            'title.required'=>"champ classe  est obligatoire",
            'title.unique'=>"The classe nom has already been taken",
            'niveau_id.required'=>"champ niveau  est obligatoire",

        ];
    }
}
