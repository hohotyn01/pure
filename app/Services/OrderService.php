<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Exceptions\OrderNotFoundException;
use App\Models\User;
use App\Models\Order;
use Config;


class OrderService extends BaseService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function findOrFail($id, $relations = null)
    {
        if (empty($id)) {
            throw new OrderNotFoundException("Order Not Found");
        }

        if (empty($relations)) {
            $order = $this->orderRepository->find($id);
        } else {
            $order = $this->orderRepository->findWithRelations($id, $relations);
        }

        if (empty($order)) {
            throw new OrderNotFoundException("Order Not Found");
        }

        return $order;
    }

    public function checkRelation($relation)
    {
        if (empty($relation)) {
            throw new OrderNotFoundException("Relation Is Empty");
        }
    }

    public function createUserOrder(User $user, array $orderData)
    {
        $orderData['user_id'] = $user->id;
        return (
        $this->orderRepository->create($orderData)
        );
    }

    public function createOrderDetail(Order $order, array $dataYourHome)
    {
        $dataYourHome['order_id'] = $order->id;

        return (
        $order->OrderDetail()->create($dataYourHome)
        );
    }

    public function createOrderMaterialsDetail(Order $order, array $dataMaterialsDetail)
    {
        $dataMaterialsDetail['order_id'] = $order->id;

        return (
        $order->orderMaterialsDetail()->create($dataMaterialsDetail)
        );
    }

    public function createOrderMaterialsFloor(Order $order, array $dataMaterialsFloor)
    {
        $dataMaterialsFloor['order_id'] = $order->id;

        return (
        $order->orderMaterialsFloor()->create($dataMaterialsFloor)
        );
    }

    public function createOrderMaterialsCountertop(Order $order, array $dataMaterialsCountertop)
    {
        $dataMaterialsCountertop['order_id'] = $order->id;

        return (
        $order->orderMaterialsCountertop()->create($dataMaterialsCountertop)
        );
    }

    public function createOrderExtras(Order $order, array $dataOrderExtras)
    {
        $dataOrderExtras['order_id'] = $order->id;

        return (
        $order->orderExtras()->create($dataOrderExtras)
        );
    }


    public function calculateAndSavePrice(Order $order)
    {
        $price = (
            $this->getHomePrice($order) +
            $this->getPersonalInfoPrice($order) +
            $this->getYourHomePrice($order) +
            $this->getMaterialsFloor($order) +
            $this->getMaterialsCountertop($order) +
            $this->getMaterialsDetail($order) +
            $this->getExtrasPrice($order)
        );

        $order->total_sum = $price;
        $order->save();
    }

    protected function getHomePrice(Order $order)
    {
        $sumBedroom = (
            $order->bedroom *
            $this->_getPriceRateByKey(
                'price.bedroom',
                $order->bedroom
            )
        );
        $sumBathroom = (
            $order->bathroom *
            $this->_getPriceRateByKey(
                'price.bathroom',
                $order->bathroom
            )
        );

        return (
            $sumBedroom +
            $sumBathroom
        );
    }

    protected function getPersonalInfoPrice(Order $order)
    {
        $cleaning_frequency = $this->_getPriceRateByKey(
            'price.cleaning_frequency',
            $order->cleaning_frequency
        );
        $cleaning_type = $this->_getPriceRateByKey(
            'price.cleaning_type',
            $order->cleaning_type
        );
        $cleaning_date = $this->_getPriceRateByKey(
            'price.cleaning_date',
            $order->cleaning_date
        );
        $home_footage = Config::get('price.home_footage') *
            $order->home_footage;

        return (
            $cleaning_frequency +
            $cleaning_type +
            $cleaning_date +
            $home_footage
        );
    }

    protected function getYourHomePrice(Order $order)
    {
        if ($order->orderDetail()->first() === null) {
            return 0;
        }

        $dogs_or_cats = $this->_getPriceRateByKey(
            'price.dogs_or_cats',
            $order->orderDetail->dogs_or_cats
        );
        if ($order->orderDetail->pets_total === null) {
            $pets_total = 0;
        } else {
            $pets_total = $this->_getPriceRateByKey(
                'price.pets_total',
                $order->orderDetail->pets_total
            );
        }
        $adults = $this->_getPriceRateByKey(
            'price.adults', $order->orderDetail->adults
        );
        $children = $this->_getPriceRateByKey(
            'price.children', $order->orderDetail->children
        );
        $rate_cleanliness = $this->_getPriceRateByKey(
            'price.rate_cleanliness',
            $order->orderDetail->rate_cleanliness
        );
        $cleaned_2_months_ago = $this->_getPriceRateByKey(
            'price.cleaned_2_months_ago',
            $order->orderDetail->cleaned_2_months_ago
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

    protected function getMaterialsFloor(Order $order)
    {
        if ($order->orderMaterialsFloor()->first() === null) {
            return 0;
        }

        $hardwood = $this->_getPriceRateByKey(
            'price.flooring.hardwood',
            $order->orderMaterialsFloor->hardwood
        );
        $cork = $this->_getPriceRateByKey(
            'price.flooring.cork',
            $order->orderMaterialsFloor->cork
        );
        $vinyl = $this->_getPriceRateByKey(
            'price.flooring.vinyl',
            $order->orderMaterialsFloor->vinyl
        );
        $concrete = $this->_getPriceRateByKey(
            'price.flooring.concrete',
            $order->orderMaterialsFloor->concrete
        );
        $carpet = $this->_getPriceRateByKey(
            'price.flooring.carpet',
            $order->orderMaterialsFloor->carpet
        );
        $naturalStone = $this->_getPriceRateByKey(
            'price.flooring.natural_stone',
            $order->orderMaterialsFloor->natural_stone
        );
        $tile = $this->_getPriceRateByKey(
            'price.flooring.tile',
            $order->orderMaterialsFloor->tile
        );
        $laminate = $this->_getPriceRateByKey(
            'price.flooring.laminate',
            $order->orderMaterialsFloor->laminate
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

    protected function getMaterialsCountertop(Order $order)
    {
        if ($order->orderMaterialsCountertop()->first() === null) {
            return 0;
        }

        //modelCountertop getting price
        $concrete_c = $this->_getPriceRateByKey(
            'price.countertops.concrete_c',
            $order->orderMaterialsCountertop->concrete_c
        );
        $quartz = $this->_getPriceRateByKey(
            'price.countertops.quartz',
            $order->orderMaterialsCountertop->quartz
        );
        $formica = $this->_getPriceRateByKey(
            'price.countertops.formica',
            $order->orderMaterialsCountertop->formica
        );
        $granite = $this->_getPriceRateByKey(
            'price.countertops.granite',
            $order->orderMaterialsCountertop->granite
        );
        $marble = $this->_getPriceRateByKey(
            'price.countertops.marble',
            $order->orderMaterialsCountertop->marble
        );
        $tile_c = $this->_getPriceRateByKey(
            'price.countertops.tile_c',
            $order->orderMaterialsCountertop->tile_c
        );
        $paper_stone = $this->_getPriceRateByKey(
            'price.countertops.paper_stone',
            $order->orderMaterialsCountertop->paper_stone
        );
        $butcher_block = $this->_getPriceRateByKey(
            'price.countertops.butcher_block',
            $order->orderMaterialsCountertop->butcher_block
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


    protected function getMaterialsDetail(Order $order)
    {
        if ($order->orderMaterialsDetail()->first() === null) {
            return 0;
        }

        //modelDetail getting price
        $stainlessSteel = $this->_getPriceRateByKey(
            'price.stainless_steel_appliances',
            $order->orderMaterialsDetail->stainless_steel_appliances
        );
        $stoveType = $this->_getPriceRateByKey(
            'price.stove_type',
            $order->orderMaterialsDetail->stove_type
        );
        $shawerDoors = $this->_getPriceRateByKey(
            'price.shawer_doors_glass',
            $order->orderMaterialsDetail->shawer_doors_glass
        );
        $mold = $this->_getPriceRateByKey(
            'price.mold',
            $order->orderMaterialsDetail->mold
        );


        return (
            $stainlessSteel +
            $stoveType +
            $shawerDoors +
            $mold
        );
    }

    protected function getExtrasPrice(Order $order)
    {
        if ($order->orderExtras()->first() === null) {
            return 0;
        }

        $insideFridge = $this->_getPriceRateByKey(
            'price.selectExtras.inside_fridge',
            $order->orderExtras->inside_fridge
        );
        $insideOven = $this->_getPriceRateByKey(
            'price.selectExtras.inside_oven',
            $order->orderExtras->inside_oven
        );
        $garageSwept = $this->_getPriceRateByKey(
            'price.selectExtras.garage_swept',
            $order->orderExtras->garage_swept
        );
        $blindsCleaning = $this->_getPriceRateByKey(
            'price.selectExtras.blinds_cleaning',
            $order->orderExtras->blinds_cleaning
        );
        $laundryWash = $this->_getPriceRateByKey(
            'price.selectExtras.laundry_wash_dry',
            $order->orderExtras->laundry_wash_dry
        );
        $serviceWeekend = $this->_getPriceRateByKey(
            'price.service_weekend',
            $order->orderExtras->service_weekend
        );
        $carpet = $this->_getPriceRateByKey(
            'price.carpet',
            $order->orderExtras->carpet
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

    protected function _getPriceRateByKey(string $key, string $value)
    {
        if (!isset(Config::get($key)[$value])) {
            throw new \Exception('Incorrect Price Rate Key or Value Provided!');
        }

        return (
        Config::get($key)[$value]
        );
    }
}