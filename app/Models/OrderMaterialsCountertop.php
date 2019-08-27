<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterialsCountertop extends Model
{
    protected $table = 'order_materials_countertops';

    protected $fillable = [
        'order_id',
        'concrete',
        'quartz',
        'formica',
        'granite',
        'marble',
        'tile',
        'paper_stone',
        'butcher_block',
    ];
}
