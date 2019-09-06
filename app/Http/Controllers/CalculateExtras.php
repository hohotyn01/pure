<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Calculate;
    use Session;


    class CalculateExtras extends Controller
    {
        public function calculate(Request $request)
        {

            $serviceWeekend = $request->serviceWeekend;
            $carpet = $request->carpet;
            $valueCheckbox = $request->valueCheckbox;
            $nameCheckbox = $request->nameCheckbox;

            $dataExtras = [$serviceWeekend, $carpet, $valueCheckbox, $nameCheckbox];

            $orderId = session::get('orderId');

            $calculate = new Calculate($orderId, $dataExtras);
            $calculate->getSum();

            return $calculate->getSum();

        }
    }
