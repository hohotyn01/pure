<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterialsFloor extends Model
{
    protected $table = 'order_materials_floors';

    protected $fillable = [
        'order_id',
        'hardwood',
        'cork',
        'vinyl',
        'concrete',
        'carpet',
        'natural_stone',
        'tile',
        'laminate',
    ];
}
