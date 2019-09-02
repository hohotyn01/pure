<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculate;

class CalculateExtras extends Controller
{
    public function calculate(){

//        dd($request);

        if ($_POST["serviceWeekend"] == 'yes'){
            echo 50;
        } else {
            echo 0;
        }
    }
}
