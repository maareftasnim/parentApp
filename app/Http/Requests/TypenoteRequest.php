<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypenoteRequest extends FormRequest
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
            "title"=>"required|max:255|unique:typenote,title,' . $this->id",
        ];
    }
    public function messages(){
        return[
            'title.required'=>"champ type est obligatoire",
            'title.unique'=>"The niveau nom has already been taken",
        ];
    }
}
