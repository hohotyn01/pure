<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Config;
    use App\Models\Order;
    use App\Models\OrderDetail;
    use App\Models\OrderMaterialsCountertop;
    use App\Models\OrderMaterialsFloor;
    use App\Models\OrderMaterialsDetail;
    use App\Models\OrderExtras;


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
            $materials = $this->yourHome();

            $modelFloor = OrderMaterialsFloor::where('order_id', $this->order->id)->first();
            $modelCountertop = OrderMaterialsCountertop::where('order_id', $this->order->id)->first();
            $modelDetail = OrderMaterialsDetail::where('order_id', $this->order->id)->first();

            //modelFloor getting price
            $hardwood = Config::get('price.flooring.hardwood')[$modelFloor->hardwood];
            $cork = Config::get('price.flooring.cork')[$modelFloor->cork];
            $vinyl = Config::get('price.flooring.vinyl')[$modelFloor->vinyl];
            $concrete = Config::get('price.flooring.concrete')[$modelFloor->concrete];
            $carpet = Config::get('price.flooring.carpet')[$modelFloor->carpet];
            $naturalStone = Config::get('price.flooring.natural_stone')[$modelFloor->natural_stone];
            $tile = Config::get('price.flooring.tile')[$modelFloor->tile];
            $laminate = Config::get('price.flooring.laminate')[$modelFloor->laminate];


            //modelCountertop getting price
            $concrete_c = Config::get('price.countertops.concrete_c')[$modelCountertop->concrete_c];
            $quartz = Config::get('price.countertops.quartz')[$modelCountertop->quartz];
            $formica = Config::get('price.countertops.formica')[$modelCountertop->formica];
            $granite = Config::get('price.countertops.granite')[$modelCountertop->granite];
            $marble = Config::get('price.countertops.marble')[$modelCountertop->marble];
            $tile_c = Config::get('price.countertops.tile_c')[$modelCountertop->tile_c];
            $paper_stone = Config::get('price.countertops.paper_stone')[$modelCountertop->paper_stone];
            $butcher_block = Config::get('price.countertops.butcher_block')[$modelCountertop->butcher_block];

            //modelDetail getting price
            $stainlessSteel = Config::get('price.stainless_steel_appliances')[$modelDetail->stainless_steel_appliances];
            $stoveType = Config::get('price.stove_type')[$modelDetail->stove_type];
            $shawerDoors = Config::get('price.shawer_doors_glass')[$modelDetail->shawer_doors_glass];
            $mold = Config::get('price.mold')[$modelDetail->mold];


            $summa = $concrete_c + $quartz + $formica + $granite + $marble + $tile_c + $paper_stone + $butcher_block +
                $stainlessSteel + $stoveType + $shawerDoors + $mold + $hardwood + $cork + $vinyl + $concrete +
                $carpet + $naturalStone + $tile + $laminate;

            return $summa + $materials;

        }

        public function extras()
        {
            $extras = $this->materials();

            $model = OrderExtras::where('order_id', $this->order->id)->first();

            $insideFridge = Config::get('price.selectExtras.inside_fridge')[$model->inside_fridge];
            $inside_oven = Config::get('price.selectExtras.inside_oven')[$model->inside_oven];
            $garage_swept = Config::get('price.selectExtras.garage_swept')[$model->garage_swept];
            $blinds_cleaning = Config::get('price.selectExtras.blinds_cleaning')[$model->blinds_cleaning];
            $laundry_wash_dry = Config::get('price.selectExtras.laundry_wash_dry')[$model->laundry_wash_dry];

            $w = Config::get('price.service_weekend')[$model->service_weekend];

            return [$insideFridge,$inside_oven,$garage_swept,$blinds_cleaning,$laundry_wash_dry];
        }
    }
