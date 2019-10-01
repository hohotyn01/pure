<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class User extends Model
{
    use Billable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_phone',
        'email' ,
        'lead_source'
    ];
}
