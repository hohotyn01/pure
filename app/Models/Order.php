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
            'about_us',
        ];

        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function orderDetail()
        {
            return $this->hasOne('App\Models\OrderDetail');
        }

        public function orderMaterialsFloor()
        {
            return $this->hasOne('App\Models\OrderMaterialsFloor');
        }

        public function orderMaterialsCountertop()
        {
            return $this->hasOne('App\Models\OrderMaterialsCountertop');
        }

        public function orderMaterialsDetail()
        {
            return $this->hasOne('App\Models\OrderMaterialsDetail');
        }

        public function orderExtras()
        {
            return $this->hasOne('App\Models\OrderExtras');
        }
        public function decryptionType()
        {
            return $this->hasOne('App\Models\DecryptionType', 'original_type', 'cleaning_type');
        }
    }
