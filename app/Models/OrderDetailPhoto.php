<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailPhoto extends Model
{
    protected $table = 'order_path';

    protected $fillable = [
        'order_id',
        'photo_path'
    ];
}
