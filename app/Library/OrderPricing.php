<?php

    namespace App\Library;

    use Config;
    use App\Models\Order;


    class OrderPricing
    {
        private $order;

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
                $this->getMaterialsFloor() +
                $this->getMaterialsCountertop() +
                $this->getMaterialsDetail() +
                $this->getExtrasPrice()
            );

            return $price;
        }

        protected function getHomePrice()
        {
            $sumBedroom = (
                $this->order->bedroom *
                $this->getPriceRateByKey(
                    'price.bedroom',
                    $this->order->bedroom
                )
            );
            $sumBathroom = (
                $this->order->bathroom *
                $this->getPriceRateByKey(
                    'price.bathroom',
                    $this->order->bathroom
                )
            );

            return (
                $sumBedroom +
                $sumBathroom
            );
        }

        protected function getPersonalInfoPrice()
        {

            $cleaning_frequency = $this->getPriceRateByKey(
                'price.cleaning_frequency',
                $this->order->cleaning_frequency
            );
            $cleaning_type = $this->getPriceRateByKey(
                'price.cleaning_type',
                $this->order->cleaning_type
            );
            $cleaning_date = $this->getPriceRateByKey(
                'price.cleaning_date',
                $this->order->cleaning_date
            );
            $home_footage = Config::get('price.home_footage') *
                $this->order->home_footage;

            return (
                $cleaning_frequency +
                $cleaning_type +
                $cleaning_date +
                $home_footage
            );
        }

        protected function getYourHomePrice()
        {
            if ($this->order->orderDetail === null) {
                return 0;
            }


            $dogs_or_cats = $this->getPriceRateByKey(
                'price.dogs_or_cats',
                $this->order->orderDetail->dogs_or_cats
            );
            if ($this->order->orderDetail->pets_total === null) {
                $pets_total = 0;
            } else {
                $pets_total = $this->getPriceRateByKey(
                    'price.pets_total',
                    $this->order->orderDetail->pets_total
                );
            }
            $adults = $this->getPriceRateByKey(
                'price.adults', $this->order->orderDetail->adults
            );
            $children = $this->getPriceRateByKey(
                'price.children', $this->order->orderDetail->children
            );
            $rate_cleanliness = $this->getPriceRateByKey(
                'price.rate_cleanliness',
                $this->order->orderDetail->rate_cleanliness
            );
            $cleaned_2_months_ago = $this->getPriceRateByKey(
                'price.cleaned_2_months_ago',
                $this->order->orderDetail->cleaned_2_months_ago
            );

            return (
                $dogs_or_cats +
                $pets_total +
                $adults +
                $children +
                $rate_cleanliness +
                $cleaned_2_months_ago
            );
        }

        protected function getMaterialsFloor()
        {
            if ($this->order->orderMaterialsFloor === null) {
                return 0;
            }

            $hardwood = $this->getPriceRateByKey(
                'price.flooring.hardwood',
                $this->order->orderMaterialsFloor->hardwood
            );
            $cork = $this->getPriceRateByKey(
                'price.flooring.cork',
                $this->order->orderMaterialsFloor->cork
            );
            $vinyl = $this->getPriceRateByKey(
                'price.flooring.vinyl',
                $this->order->orderMaterialsFloor->vinyl
            );
            $concrete = $this->getPriceRateByKey(
                'price.flooring.concrete',
                $this->order->orderMaterialsFloor->concrete
            );
            $carpet = $this->getPriceRateByKey(
                'price.flooring.carpet',
                $this->order->orderMaterialsFloor->carpet
            );
            $naturalStone = $this->getPriceRateByKey(
                'price.flooring.natural_stone',
                $this->order->orderMaterialsFloor->natural_stone
            );
            $tile = $this->getPriceRateByKey(
                'price.flooring.tile',
                $this->order->orderMaterialsFloor->tile
            );
            $laminate = $this->getPriceRateByKey(
                'price.flooring.laminate',
                $this->order->orderMaterialsFloor->laminate
            );

            return (
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

        protected function getMaterialsCountertop()
        {
            if ($this->order->orderMaterialsCountertop === null) {
                return 0;
            }

            //modelCountertop getting price
            $concrete_c = $this->getPriceRateByKey(
                'price.countertops.concrete_c',
                $this->order->orderMaterialsCountertop->concrete_c
            );
            $quartz = $this->getPriceRateByKey(
                'price.countertops.quartz',
                $this->order->orderMaterialsCountertop->quartz
            );
            $formica = $this->getPriceRateByKey(
                'price.countertops.formica',
                $this->order->orderMaterialsCountertop->formica
            );
            $granite = $this->getPriceRateByKey(
                'price.countertops.granite',
                $this->order->orderMaterialsCountertop->granite
            );
            $marble = $this->getPriceRateByKey(
                'price.countertops.marble',
                $this->order->orderMaterialsCountertop->marble
            );
            $tile_c = $this->getPriceRateByKey(
                'price.countertops.tile_c',
                $this->order->orderMaterialsCountertop->tile_c
            );
            $paper_stone = $this->getPriceRateByKey(
                'price.countertops.paper_stone',
                $this->order->orderMaterialsCountertop->paper_stone
            );
            $butcher_block = $this->getPriceRateByKey(
                'price.countertops.butcher_block',
                $this->order->orderMaterialsCountertop->butcher_block
            );

            return (
                $concrete_c +
                $quartz +
                $formica +
                $granite +
                $marble +
                $tile_c +
                $paper_stone +
                $butcher_block
            );
        }


        protected function getMaterialsDetail()
        {
            if ($this->order->orderMaterialsDetail === null) {
                return 0;
            }

            //modelDetail getting price
            $stainlessSteel = $this->getPriceRateByKey(
                'price.stainless_steel_appliances',
                $this->order->orderMaterialsDetail->stainless_steel_appliances
            );
            $stoveType = $this->getPriceRateByKey(
                'price.stove_type',
                $this->order->orderMaterialsDetail->stove_type
            );
            $shawerDoors = $this->getPriceRateByKey(
                'price.shawer_doors_glass',
                $this->order->orderMaterialsDetail->shawer_doors_glass
            );
            $mold = $this->getPriceRateByKey(
                'price.mold',
                $this->order->orderMaterialsDetail->mold
            );


            return (
                $stainlessSteel +
                $stoveType +
                $shawerDoors +
                $mold
            );
        }

        protected function getExtrasPrice()
        {
            if ($this->order->orderExtras === null) {
                return 0;
            }

            $insideFridge = $this->getPriceRateByKey(
                'price.selectExtras.inside_fridge',
                $this->order->orderExtras->inside_fridge
            );
            $insideOven = $this->getPriceRateByKey(
                'price.selectExtras.inside_oven',
                $this->order->orderExtras->inside_oven
            );
            $garageSwept = $this->getPriceRateByKey(
                'price.selectExtras.garage_swept',
                $this->order->orderExtras->garage_swept
            );
            $blindsCleaning = $this->getPriceRateByKey(
                'price.selectExtras.blinds_cleaning',
                $this->order->orderExtras->blinds_cleaning
            );
            $laundryWash = $this->getPriceRateByKey(
                'price.selectExtras.laundry_wash_dry',
                $this->order->orderExtras->laundry_wash_dry
            );
            $serviceWeekend = $this->getPriceRateByKey(
                'price.service_weekend',
                $this->order->orderExtras->service_weekend
            );
            $carpet = $this->getPriceRateByKey(
                'price.carpet',
                $this->order->orderExtras->carpet
            );

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

        protected function getPriceRateByKey(string $key, string $value)
        {
            if (!isset(Config::get($key)[$value])) {
                throw new \Exception('Incorrect Price Rate Key or Value Provided!');
            }

            return (
            Config::get($key)[$value]
            );
        }

    }
