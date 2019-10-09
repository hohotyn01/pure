<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderNotFoundException;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Session;


class CalculateExtras extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function calculate(Request $request)
    {
        // Getting data form ajax
        $responseData = $request->input('data');

        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderExtras']
            );

            $this->orderService->checkRelation($orderModel->orderExtras);
            $orderModel->orderExtras->update($responseData);
        } catch (OrderNotFoundException $e) {
            $this->orderService->createOrderExtras(
                $orderModel,
                $responseData
            );
        }

        // Calculate And Save
        $this->orderService->calculateAndSavePrice($orderModel);

        return response()->json([
            'data' => $orderModel->total_sum
        ]);
    }
}
