<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursRequest extends FormRequest
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
            "title" => 'required|bail|alpha|min:3|max:15',
            'document' => 'required|mimes:doc,docx,pdf',
            'image' => ['mimes:jpg,jpeg,png'],
            'video' => 'mimes:mp4|max:60000',
            'lien' => ['regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/|vimeo\.com\/)\S+$/'],
            "matier_id" => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'document.required' => 'The document field is required.',
            'title.alpha' => 'The title field must only contain alphabetic characters.',
            'title.min' => 'The title field must be at least :min characters.',
            'title.max' => 'The title field may not be greater than :max characters.',
            'document.mimes' => 'The document must be a file of type: :values.',
            'image.mimes' => 'The image must be a file of type: :values.',
            'video.mimes' => 'The video must be a file of type: :values.',
            'video.max' => 'The video may not be greater than :max kilobytes.',
            'lien.regex' => 'The lien format is invalid.',
            'matier_id.required' => 'The matier_id field is required.'
        ];
    }

}
