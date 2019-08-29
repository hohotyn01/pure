<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderExtras extends Model
{
    protected $table = 'order_extras';
    
    protected $fillable = [
        'order_id',
        'inside_fridge',
        'inside_oven',
        'garage_swept',
        'blinds_cleaning',
        'laundry_wash_dry',
        'service_weekend',
        'carpet'
    ];
}
