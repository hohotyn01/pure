<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestHomePost extends FormRequest
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
            'bedroom' => 'required|max:10',
            'bathroom' => 'required|max:5',
            'zip_code' => 'required|max:10',
            'email' => 'required|email|max:150',
        ];
    }
}
