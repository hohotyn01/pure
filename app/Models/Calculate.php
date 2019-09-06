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
        private $order;

        //type hint Order $order
        public function __construct(Order $order)
        {
            $this->order = $order;
        }

        public function getSum()
        {
            $price = (
                $this->getHomePrice() +
                $this->getPersonalInfoPrice() +
                $this->getYourHomePrice() +
                $this->getMaterialsPrice() +
                $this->getExtrasPrise()
            );

            return $price;


//            $model = OrderExtras::where('order_id', $this->order->id)->first();
//
//            $insideFridge = Config::get("price.selectExtrasTwo.inside_fridge")[$this->dataExtras[3] == 'inside_fridge' ? $this->dataExtras[2] : 'false'];
//            $insideOven = Config::get("price.selectExtrasTwo.inside_oven")[isset($this->dataExtras[3]) && $this->dataExtras[3] == 'inside_oven' ? $this->dataExtras[2] : 'false'];
//            $garageSwept = Config::get("price.selectExtrasTwo.garage_swept")[isset($this->dataExtras[3])? $this->dataExtras[2]:'false'];
//            $blindsCleaning = Config::get("price.selectExtrasTwo.blinds_cleaning")[isset($this->dataExtras[3])? $this->dataExtras[2]:'false'];
//            $laundryWash = Config::get("price.selectExtrasTwo.laundry_wash_dry")[isset($this->dataExtras[3])? $this->dataExtras[2]:'false'];
////
//            $serviceWeekend = Config::get("price.service_weekend")[$model->service_weekend];
//            $carpet = Config::get("price.carpet")[$model->carpet];

//            return [$insideFridge, $insideOven];
        }

        protected function getHomePrice()
        {
            $sumBedroom = $this->order->bedroom * Config::get('price.bedroom')[$this->order->bedroom];
            $sumBathroom = $this->order->bathroom * Config::get('price.bathroom')[$this->order->bathroom];

            return $sumBedroom + $sumBathroom;
        }

        protected function getPersonalInfoPrice()
        {
            $cleaning_frequency = Config::get('price.cleaning_frequency')[$this->order->cleaning_frequency];
            $cleaning_type = Config::get('price.cleaning_type')[$this->order->cleaning_type];
            $cleaning_date = Config::get('price.cleaning_date')[$this->order->cleaning_date];
            $home_footage = Config::get('price.home_footage') * $this->order->home_footage;

            return $cleaning_frequency + $cleaning_type + $cleaning_date + $home_footage;
        }

        protected function getYourHomePrice()
        {
            $model = $this->order->orderDetail;

            $dogs_or_cats = Config::get('price.dogs_or_cats')[$model->dogs_or_cats];
            $pets_total = Config::get('price.pets_total')[$model->pets_total];
            $adults = Config::get('price.adults')[$model->adults];
            $children = Config::get('price.children')[$model->children];
            $rate_cleanliness = Config::get('price.rate_cleanliness')[$model->rate_cleanliness];
            $cleaned_2_months_ago = Config::get('price.cleaned_2_months_ago')[$model->cleaned_2_months_ago];

            return $dogs_or_cats + $pets_total + $adults + $children + $rate_cleanliness + $cleaned_2_months_ago;
        }

        protected function getMaterialsPrice()
        {
            $modelFloor = $this->order->OrderMaterialsFloor;
            $modelCountertop = $this->order->OrderMaterialsCountertop;
            $modelDetail = $this->order->OrderMaterialsDetail;

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
                $stainlessSteel + $stoveType + $shawerDoors + $mold +
                $hardwood + $cork + $vinyl + $concrete + $carpet + $naturalStone + $tile + $laminate;

            return $summa;
        }

        protected function getExtrasPrise()
        {
            $model = $this->order->OrderExtras;

            $insideFridge = Config::get('price.selectExtras.inside_fridge')[$model->inside_fridge];
            $insideOven = Config::get('price.selectExtras.inside_oven')[$model->inside_oven];
            $garageSwept = Config::get('price.selectExtras.garage_swept')[$model->garage_swept];
            $blindsCleaning = Config::get('price.selectExtras.blinds_cleaning')[$model->blinds_cleaning];
            $laundryWash = Config::get('price.selectExtras.laundry_wash_dry')[$model->laundry_wash_dry];

            $serviceWeekend = Config::get('price.service_weekend')[$model->service_weekend];
            $carpet = Config::get('price.carpet')[$model->carpet];

            $summa = $insideFridge + $insideOven + $garageSwept + $blindsCleaning + $laundryWash +
                $serviceWeekend + $carpet;

            return $summa;
        }


    }
