<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
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
            'semester.*.title'=>'required|min:2|max:15|unique:trimester,title,' . $this->id,

        ];
    }public function message()
{
    return [
        'title.required'=>'champs est obligatoire',
        'title.unique'=>'champs deja existe'
    ];
}

}
