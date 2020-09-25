<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    protected function getIndex(){
        // $districts=DB::table('districts')->where('province_id',1)->select('id','name')->get();
        // return response()->json($districts);
        return view('index');
    }

    // ajax show districts
    public function showDistricts(Request $request){
        if($request->ajax()){
            $districts=DB::table('districts')->where('province_id',$request->province_id)->select('id','name')->get();
        }
        return response()->json($districts);
    }
    public function showWards(Request $request){
        if($request->ajax()){
            $wards=DB::table('wards')->where('district_id',$request->district_id)->select('id','name')->get();
        }
        return response()->json($wards);
    }
}
