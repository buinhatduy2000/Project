<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdeaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'idea_title' => 'required|max:255',
            'description' => 'max:255',
            'category_id' => 'required',

            'files.*' => 'sometimes|required|file|mimes:pdf,doc,docs,docx|max:2048'
        ];
    }
}
