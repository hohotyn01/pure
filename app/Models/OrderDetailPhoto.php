<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetailPhoto extends Model
{
    use softDeletes;

    protected $table = 'order_path';

    protected $fillable = [
        'order_id',
        'photo_path'
    ];
}
