<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
   
    public function test(){


        return \App\Models\test::get();

        return ['msg'=> "suucessfully get"];
    }
}
