<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;

class PersonalInfo extends Controller
{
    public function index (Request $request){

        if ($request->isMethod('get')){
            return view('personal_info');
        }

        if($request->isMethod('post')){
            echo 1;
        }
    }
}
