<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'bedroom',
        'bathroom',
        'cleaning_frequency',
        'cleaning_type',
        'cleaning_date',
        'home_footage',
        'street_address',
        'apt',
        'city',
        'zip_code',
        'per_cleaning',
        'total_sum',
        'status',
        'about_us'
    ];
}
