<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestExtrasPost extends FormRequest
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
            // Checkbox
            'inside_fridge' => 'boolean',
            'inside_oven' => 'boolean',
            'garage_swept' => 'boolean',
            'blinds_cleaning' => 'boolean',
            'laundry_wash_dry' => 'boolean',
            // Radio
            'service_weekend' => 'required|in:1,0',
            'carpet' => 'required|in:1,0',
        ];
    }
}
