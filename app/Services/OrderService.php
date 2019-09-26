<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\OrderRepository;
use App\Models\Order;
use http\Env\Request;


class OrderService extends BaseService
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->repo = $orderRepository;
    }

    public function createUserOrder(User $user, array $orderData)
    {
        $orderData['user_id'] = $user->id;

        return (
        $this->create($orderData)
        );
    }

    public function createOrderRelationships(Order $order, array $orderDetailData, $relationships)
    {
        $orderDetailData['order_id'] = $order->id;

        return (
        $order->$relationships()->create($orderDetailData)
        );
    }

    public function updateOrderRelationships(Order $order, array $orderDetailData, $relationships)
    {
        $orderDetailData['order_id'] = $order->id;

        return (
            $order->$relationships()->update($orderDetailData)
        );
    }


    public function refactoringRequestDataMaterials(array $requestToArray)
    {
        $dataFlooring['hardwood'] = array_key_exists("hardwood", $requestToArray) ? 1 : 0;
        $dataFlooring['cork'] = array_key_exists("cork", $requestToArray) ? 1 : 0;
        $dataFlooring['vinyl'] = array_key_exists("vinyl", $requestToArray) ? 1 : 0;
        $dataFlooring['concrete'] = array_key_exists("concrete", $requestToArray) ? 1 : 0;
        $dataFlooring['carpet'] = array_key_exists("carpet", $requestToArray) ? 1 : 0;
        $dataFlooring['natural_stone'] = array_key_exists("natural_stone", $requestToArray) ? 1 : 0;
        $dataFlooring['tile'] = array_key_exists("tile", $requestToArray) ? 1 : 0;
        $dataFlooring['laminate'] = array_key_exists("laminate", $requestToArray) ? 1 : 0;
        $dataFlooring[''] =

        $dataCounterTops['concrete_c'] = array_key_exists("concrete_c", $requestToArray) ? 1 : 0;
        $dataCounterTops['quartz'] = array_key_exists("quartz", $requestToArray) ? 1 : 0;
        $dataCounterTops['formica'] = array_key_exists("formica", $requestToArray) ? 1 : 0;
        $dataCounterTops['granite'] = array_key_exists("granite", $requestToArray) ? 1 : 0;
        $dataCounterTops['marble'] = array_key_exists("marble", $requestToArray) ? 1 : 0;
        $dataCounterTops['tile_c'] = array_key_exists("tile_c", $requestToArray) ? 1 : 0;
        $dataCounterTops['paper_stone'] = array_key_exists("paper_stone", $requestToArray) ? 1 : 0;
        $dataCounterTops['butcher_block'] = array_key_exists("butcher_block", $requestToArray) ? 1 : 0;

        $dataDetail['stainless_steel_appliances'] = $requestToArray['stainless_steel_appliances'];
        $dataDetail['stove_type'] = $requestToArray['stove_type'];
        $dataDetail['shawer_doors_glass'] = $requestToArray['shawer_doors_glass'];
        $dataDetail['mold'] = $requestToArray['mold'];
        $dataDetail['areas_special_attention'] = $requestToArray['areas_special_attention'];
        $dataDetail['anything_know'] = $requestToArray['anything_know'];

        return [
            'dataFlooring' => $dataFlooring,
            'dataCounterTops' => $dataCounterTops,
            'dataDetail' => $dataDetail
        ];
    }

}