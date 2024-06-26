<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            "name"=>"required|bail|max:255|unique:module,name,' . $this->id",
        ];
    }
    public function messages(){
        return[
            'name.required'=>"champ module est obligatoire",
            'name.unique'=>"The module nom has already been taken",
            'name.alpha'=>"The module nom  must be alpha",
        ];
    }
}
