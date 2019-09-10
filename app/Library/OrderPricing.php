<?php

    namespace App\Library;

    use Config;
    use App\Models\Order;


    class OrderPricing
    {
        private $order;

        //type hint Order $order
        public function __construct(Order $order)
        {
            $this->order = $order;
        }

        public function calculate()
        {
            $price = (
                $this->getHomePrice() +
                $this->getPersonalInfoPrice() +
                $this->getYourHomePrice() +
                $this->getMaterialsPrice() +
                $this->getExtrasPrice()
            );

            return $price;
        }

        protected function getHomePrice()
        {
            $sumBedroom = $this->order->bedroom * $this->getPriceRateByKey('price.bedroom', $this->order->bedroom);
            $sumBathroom = $this->order->bathroom * $this->getPriceRateByKey('price.bathroom', $this->order->bathroom);

            return (
                $sumBedroom +
                $sumBathroom
            );
        }

        protected function getPersonalInfoPrice()
        {
            $cleaning_frequency = $this->getPriceRateByKey('price.cleaning_frequency', $this->order->cleaning_frequency);
            $cleaning_type = $this->getPriceRateByKey('price.cleaning_type', $this->order->cleaning_type);
            $cleaning_date = $this->getPriceRateByKey('price.cleaning_date', $this->order->cleaning_date);
            $home_footage = Config::get('price.home_footage') * $this->order->home_footage;

            return (
                $cleaning_frequency +
                $cleaning_type +
                $cleaning_date +
                $home_footage
            );
        }

        protected function getYourHomePrice()
        {
            $model = $this->order->orderDetail;

            $dogs_or_cats = $this->getPriceRateByKey('price.dogs_or_cats', $model->dogs_or_cats);
            $pets_total = $this->getPriceRateByKey('price.pets_total', $model->pets_total);
            $adults = $this->getPriceRateByKey('price.adults', $model->adults);
            $children = $this->getPriceRateByKey('price.children', $model->children);
            $rate_cleanliness = $this->getPriceRateByKey('price.rate_cleanliness', $model->rate_cleanliness);
            $cleaned_2_months_ago = $this->getPriceRateByKey('price.cleaned_2_months_ago', $model->cleaned_2_months_ago);

            return (
                $dogs_or_cats +
                $pets_total +
                $adults +
                $children +
                $rate_cleanliness +
                $cleaned_2_months_ago
            );
        }

        protected function getMaterialsPrice()
        {
            $modelFloor = $this->order->OrderMaterialsFloor;
            $modelCountertop = $this->order->OrderMaterialsCountertop;
            $modelDetail = $this->order->OrderMaterialsDetail;

            //modelFloor getting price
            $hardwood = $this->getPriceRateByKey('price.flooring.hardwood', $modelFloor->hardwood);
            $cork = $this->getPriceRateByKey('price.flooring.cork', $modelFloor->cork);
            $vinyl = $this->getPriceRateByKey('price.flooring.vinyl', $modelFloor->vinyl);
            $concrete = $this->getPriceRateByKey('price.flooring.concrete', $modelFloor->concrete);
            $carpet = $this->getPriceRateByKey('price.flooring.carpet', $modelFloor->carpet);
            $naturalStone = $this->getPriceRateByKey('price.flooring.natural_stone', $modelFloor->natural_stone);
            $tile = $this->getPriceRateByKey('price.flooring.tile', $modelFloor->tile);
            $laminate = $this->getPriceRateByKey('price.flooring.laminate', $modelFloor->laminate);


            //modelCountertop getting price
            $concrete_c = $this->getPriceRateByKey('price.countertops.concrete_c', $modelCountertop->concrete_c);
            $quartz = $this->getPriceRateByKey('price.countertops.quartz', $modelCountertop->quartz);
            $formica = $this->getPriceRateByKey('price.countertops.formica', $modelCountertop->formica);
            $granite = $this->getPriceRateByKey('price.countertops.granite', $modelCountertop->granite);
            $marble = $this->getPriceRateByKey('price.countertops.marble', $modelCountertop->marble);
            $tile_c = $this->getPriceRateByKey('price.countertops.tile_c', $modelCountertop->tile_c);
            $paper_stone = $this->getPriceRateByKey('price.countertops.paper_stone', $modelCountertop->paper_stone);
            $butcher_block = $this->getPriceRateByKey('price.countertops.butcher_block', $modelCountertop->butcher_block);

            //modelDetail getting price
            $stainlessSteel = $this->getPriceRateByKey('price.stainless_steel_appliances', $modelDetail->stainless_steel_appliances);
            $stoveType = $this->getPriceRateByKey('price.stove_type', $modelDetail->stove_type);
            $shawerDoors = $this->getPriceRateByKey('price.shawer_doors_glass', $modelDetail->shawer_doors_glass);
            $mold = $this->getPriceRateByKey('price.mold', $modelDetail->mold);


            return (
                $concrete_c + 
                $quartz + 
                $formica +
                $granite +
                $marble +
                $tile_c +
                $paper_stone +
                $butcher_block +
                $stainlessSteel +
                $stoveType +
                $shawerDoors +
                $mold +
                $hardwood +
                $cork +
                $vinyl +
                $concrete +
                $carpet +
                $naturalStone +
                $tile +
                $laminate
            );
        }

        protected function getExtrasPrice()
        {

            $insideFridge = $this->getPriceRateByKey('price.selectExtras.inside_fridge', $this->order->orderExtras->inside_fridge);
            $insideOven = $this->getPriceRateByKey('price.selectExtras.inside_oven', $this->order->orderExtras->inside_oven);
            $garageSwept = $this->getPriceRateByKey('price.selectExtras.garage_swept', $this->order->orderExtras->garage_swept);
            $blindsCleaning = $this->getPriceRateByKey('price.selectExtras.blinds_cleaning', $this->order->orderExtras->blinds_cleaning);
            $laundryWash = $this->getPriceRateByKey('price.selectExtras.laundry_wash_dry', $this->order->orderExtras->laundry_wash_dry);
            $serviceWeekend = $this->getPriceRateByKey('price.service_weekend', $this->order->orderExtras->service_weekend);
            $carpet = $this->getPriceRateByKey('price.carpet', $this->order->orderExtras->carpet);

            return (
                $insideFridge +
                $insideOven +
                $garageSwept +
                $blindsCleaning +
                $laundryWash +
                $serviceWeekend +
                $carpet
            );
        }

        protected function getPriceRateByKey(string $key, string $value) {
            if (!isset(Config::get($key)[$value])) {
                throw new \Exception('Incorrect Price Rate Key or Value Provided!');
            }

            return (
                Config::get($key)[$value]
            );
        }

    }
