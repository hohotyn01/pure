<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMaterialsPost extends FormRequest
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
            // Floor
            'hardwood' => 'boolean',
            'cork' => 'boolean',
            'vinyl' => 'boolean',
            'concrete' => 'boolean',
            'carpet' => 'boolean',
            'natural_stone' => 'boolean',
            'tile' => 'boolean',
            'laminate' => 'boolean',
            // Floor
            // Countertop
            'concrete_c' => 'boolean',
            'quartz' => 'boolean',
            'formica' => 'boolean',
            'granite' => 'boolean',
            'marble' => 'boolean',
            'tile_c' => 'boolean',
            'paper_stone' => 'boolean',
            'butcher_block' => 'boolean',
            // Countertop
            // Detail
            'stainless_steel_appliances' => 'required|in:yes,no',
            'stove_type' => 'required|in:yes,no',
            'shawer_doors_glass' => 'required|in:yes,no',
            'mold' => 'required|in:yes,no',
            'areas_special_attention' => 'max:255',
            'anything_know' => 'max:255',
            //Detail
        ];
    }
}
