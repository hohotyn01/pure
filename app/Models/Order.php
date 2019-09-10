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

        public function orderDetail()
        {
            return $this->hasOne('App\Models\OrderDetail');
        }

        public function OrderMaterialsFloor()
        {
            return $this->hasOne('App\Models\OrderMaterialsFloor');
        }

        public function orderMaterialsCountertop()
        {
            return $this->hasOne('App\Models\OrderMaterialsCountertop');
        }

        public function OrderMaterialsDetail()
        {
            return $this->hasOne('App\Models\OrderMaterialsDetail');
        }

        public function orderExtras()
        {
            return $this->hasOne('App\Models\OrderExtras');
        }
    }
