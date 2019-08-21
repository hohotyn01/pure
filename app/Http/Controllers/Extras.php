<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Extras extends Controller
{
    public function index (Request $request){

        if ($request->isMethod('get')){
            return view('extras');
        }

        if($request->isMethod('post')){
            echo 1;
        }
    }
}
