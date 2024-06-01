<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvocationRequest extends FormRequest
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
            'title' => 'required|alpha|bail|max:95',
            'objet' => 'required|bail|max:225',
            'raison' => 'required|alpha|bail|max:225',
            'etudiant_id' => 'required|array',

        ];
    }

    public function message()
    {
        return[
            'title.required'=>"champ  est obligatoire",
            'objet.required'=>"champ  est obligatoire",
            'raison.required'=>"champ  est obligatoire",
            'etudiant_id.required'=>"champ  est obligatoire",
            'title.alpha'=>"The title nom  must be alpha",
            'objet.bail'=>"The object nom  must be alpha",
            'raison.alpha'=>"The raison nom  must be alpha",
            'title.max'=>"The title max lenght 95",
            'objet.max'=>"The object max lenght 225",
            'raison.max'=>"The raison max lenght 225",
        ];


    }
}
