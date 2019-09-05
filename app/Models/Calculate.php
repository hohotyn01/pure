<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Config;
    use Order;
    use OrderDetail;
    use OrderDetailPhoto;
    use OrderExtras;
    use OrderMaterialsCountertop;
    use OrderMaterialsDetail;
    use OrderMaterialsFloor;
    use User;


    class Calculate extends Model
    {
        private $dataExtras;
        private $order;

        public function __construct($orderId, $dataExtras = [])
        {
            if (!empty($dataExtras)) {
                $this->dataExtras = $dataExtras;
            }
            $this->order = Order::find($orderId);
        }

        public function getSum()
        {
        }

        public function homeSum()
        {
            $sumBedroom = $this->order->bedroom * Config::get('price.bedroom')[$this->order->bedroom];
            $sumBathroom = $this->order->bathroom * Config::get('price.bathroom')[$this->order->bathroom];

            return $sumBedroom + $sumBathroom;
        }

        public function personalInfoSum()
        {
            $cleaning_frequency = Config::get('price.cleaning_frequency')[$this->order->cleaning_frequency];
            $cleaning_type = Config::get('price.cleaning_type')[$this->order->cleaning_type];
            $cleaning_date = Config::get('price.cleaning_date')[$this->order->cleaning_date];
            $home_footage = Config::get('price.home_footage') * $this->order->home_footage;

            return $cleaning_frequency + $cleaning_type + $cleaning_date + $home_footage;
        }

        public function yourHome()
        {

        }

        public function materials()
        {

        }

        public function extras()
        {

        }
    }
