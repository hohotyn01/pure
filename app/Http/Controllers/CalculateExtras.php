<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Calculate;

    class CalculateExtras extends Controller
    {
        public function calculate(Request $request)
        {

            $serviceWeekend = $request->serviceWeekend;
            $carpet = $request->carpet;
            $valueCheckbox = $request->valueCheckbox;
            $nameCheckbox = $request->nameCheckbox;

            $dataExtras = [$serviceWeekend, $carpet, $valueCheckbox, $nameCheckbox];

            $calculate = new Calculate($dataExtras);
            $calculate->getSum();

        }
    }
