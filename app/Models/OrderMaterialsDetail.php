<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterialsDetail extends Model
{
    protected $table = 'order_materials_details';

    protected $fillable = [
        'order_id',
        'stainless_steel_appliances',
        'stove_type',
        'shawer_doors_glass',
        'mold',
        'areas_special_attention',
        'anything_know'
    ];
}
