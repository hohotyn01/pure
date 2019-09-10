<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Library\OrderPricing;
    use App\Models\Order;
    use App\Models\OrderExtras;
    use Session;


    class CalculateExtras extends Controller
    {
        public function calculate(Request $request)
        {
            // Add Session
            $orderId = Session::get('orderId');

            // Getting data form ajax
            $requestData = $request->input('data');

            // Eager loading OrderExtras
            $order = Order::with('orderExtras')->findOrFail($orderId);

            if ($order->orderExtras === null) {
                $orderExtras = new OrderExtras($requestData);
                $order->orderExtras()->save($orderExtras);
            } else {
                $order->orderExtras->update($requestData);
            }

            // Calculate
            $orderPricing = new OrderPricing($order);

            return response()->json([
                'data' => $orderPricing->calculate()
            ]);
        }
    }
