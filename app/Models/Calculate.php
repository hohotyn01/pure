<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Config;
    use App\Models\Order;
    use App\Models\OrderDetail;


    class Calculate extends Model
    {
        private $dataExtras;
        private $order;

        public function __construct($orderId,  $dataExtras = [])
        {
            if (!empty($dataExtras)) {
                $this->dataExtras = $dataExtras;
            }

            $this->order = Order::find($orderId);

        }


        public function homeSum()
        {
            $sumBedroom = $this->order->bedroom * Config::get('price.bedroom')[$this->order->bedroom];
            $sumBathroom = $this->order->bathroom * Config::get('price.bathroom')[$this->order->bathroom];

            return $sumBedroom + $sumBathroom;

        }

        public function personalInfoSum()
        {
            $personalInfoSum = $this->homeSum();

            $cleaning_frequency = Config::get('price.cleaning_frequency')[$this->order->cleaning_frequency];
            $cleaning_type = Config::get('price.cleaning_type')[$this->order->cleaning_type];
            $cleaning_date = Config::get('price.cleaning_date')[$this->order->cleaning_date];
            $home_footage = Config::get('price.home_footage') * $this->order->home_footage;

            $personalInfoSum += $cleaning_frequency + $cleaning_type + $cleaning_date + $home_footage;

            return $personalInfoSum;
        }

        public function yourHome()
        {
            $yourHome = $this->personalInfoSum();

            $model = OrderDetail::where('order_id', $this->order->id)->first();

            $dogs_or_cats = Config::get('price.dogs_or_cats')[$model->dogs_or_cats];
            $pets_total = Config::get('price.pets_total')[$model->pets_total];
            $adults = Config::get('price.adults')[$model->adults];
            $children = Config::get('price.children')[$model->children];
            $rate_cleanliness = Config::get('price.rate_cleanliness')[$model->rate_cleanliness];
            $cleaned_2_months_ago = Config::get('price.cleaned_2_months_ago')[$model->cleaned_2_months_ago];

            $yourHome += $dogs_or_cats + $pets_total + $adults + $children + $rate_cleanliness + $cleaned_2_months_ago;

            return $yourHome;

        }

        public function materials()
        {

        }

        public function extras()
        {

        }
    }
