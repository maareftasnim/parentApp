<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalleRequest extends FormRequest
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
            'salle.*.sallename'=>'required|min:2|max:15|unique:salle,sallename,'.$this->id,
        ];
    }
    public function message()
    {
       return [
           'sallename.required'=>'salle est obligatoire',
           'sallename.unique'=>'ce champs deja existe',
       ];
    }
}
