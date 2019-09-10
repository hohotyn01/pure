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
            $orderId = Session::get('orderId');
            $requestData = $request->input('data');
            $order = Order::with('orderExtras')->findOrFail($orderId);
            if ($order->orderExtras === null) {
                $orderExtras = new OrderExtras($requestData);
                // foreach ($requestData as $key => $value) {
                //     $orderExtras->$key = $value;
                // }
                // unset($key, $value);
                $order->orderExtras()->save($orderExtras);
            } else {
                $order->orderExtras->update($requestData);
            }

            $orderPricing = new OrderPricing($order);

            return response()->json([
                'data' => [
                    'price' => $orderPricing->calculate()
                ]
            ]);








//            //            $serviceWeekend = $request->serviceWeekend;
////            $carpet = $request->carpet;
////            $valueCheckbox = $request->valueCheckbox;
////            $nameCheckbox = $request->nameCheckbox;
//
////            $extras = new OrderExtras;
////            $extras->carpet = $carpet;
//
//            $id = Session::get('orderId');
//            $data = $request->except('_token', '');
//            $data['order_id'] = $id;
//
//            $order = Order::where('id', Session::get('orderId'))->first();
//
////            $dataExtras = [$serviceWeekend, $carpet, $valueCheckbox, $nameCheckbox];
//
//
//            $calculate = new Calculate($order);
//            $calculate->getSum();
//
//            return $calculate->getSum();




        }
    }
