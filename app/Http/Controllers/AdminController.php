<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function getLogin(){
        return view('admin.admin_login');
    }
    protected function getDashboard(){
        return view('admin.dashboard');
    }
}
