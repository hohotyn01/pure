<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPersonalInfo extends FormRequest
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
            'cleaning_frequency' => 'required|in:once,weekly,biweekly,monthly',
            'cleaning_type' => 'required|in:deep_or_spring,move_in,move_out,post_remodeling',
            'cleaning_date' => 'required|in:next_available,this_week,next_week,this_month,i_am_flexible,just_need_a_quote',
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'street_address' => 'required|max:150',
            'apt' => 'max:15',
            'city' => 'required|max:150',
            'home_footage' => 'required|max:4',
            'mobile_phone' => 'required|between:9,15',
            'about_us' => 'required|in:cleaning_for_reason'
        ];
    }
}
