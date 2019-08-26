<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class OrderDetail extends Model
    {
        protected $table = 'order_details';

        protected $fillable = [
            'order_id',
            'dogs_or_cats',
            'pets_total',
            'adults',
            'children',
            'rate_cleanliness',
            'cleaned_2_months_ago',
            'differently'
    ];
}
