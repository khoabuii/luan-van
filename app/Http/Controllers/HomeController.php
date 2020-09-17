<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected function getIndex(){
        return view('index');
    }
}
