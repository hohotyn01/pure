<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestYourHome extends FormRequest
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
            'dogs_or_cats' => 'required|in:none,dog,cat,both',
            'pets_total' => 'in:pet_1,pet_2,pet_3_more|required_if:dogs_or_cats,dog,cat,both',
            'adults' => 'required|in:none,1_2,3_4,5_and_more',
            'children' => 'required|in:none_children,1,2,3_and_more',
            'rate_cleanliness' => 'required|max:10',
            'cleaned_2_months_ago' => 'required|in:yes,no',
            'differently' => 'required|max:255',
            // Photo Model
            'photo.*' => 'image|mimes:jpeg,png,jpg',
            'photo' => 'max:8',
        ];
    }
}
