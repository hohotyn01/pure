<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YourHome extends Controller
{
    public function index (Request $request){

        if ($request->isMethod('get')){
            return view('your_home');
        }

        if($request->isMethod('post')){
            echo 1;
        }
    }
}
