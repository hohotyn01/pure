<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterialsCountertop extends Model
{
    protected $table = 'order_materials_countertops';

    protected $fillable = [
        'order_id',
        'concrete_c',
        'quartz',
        'formica',
        'granite',
        'marble',
        'tile_c',
        'paper_stone',
        'butcher_block',
    ];
}
