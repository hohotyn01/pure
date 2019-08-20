<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;

class Home extends Controller
{
    public function index (Request $request){

        if ($request->isMethod('get')){
            return view('home');
        }

        if($request->isMethod('post')){
            echo 1;
        }
    }
}
