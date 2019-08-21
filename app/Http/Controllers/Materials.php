<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Materials extends Controller
{
    public function index (Request $request){

        if ($request->isMethod('get')){
            return view('materials');
        }

        if($request->isMethod('post')){
            echo 1;
        }
    }
}
