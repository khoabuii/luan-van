<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Sitters;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Closure;

class AdminController extends Controller
{
    //
    function getLogin(){
        return view('admin.admin_login');
    }
    public function postLogin(Request $request){
        // if(Session('admin')){
        //     return redirect('admin/dashboard');
        // }
        $email=$request->email;
        $password=md5($request->email);
        $user=User::where('email',$email)->where('password',$password)->get();
        if(count($user)>0){
            $request->session('admin')->put('admin',true);
            return redirect('admin/dashboard');
        }else{
            return back()->with('error','Đăng nhập thất bại');
        }
    }
    // logout
    public function getLogout(Request $request){
        $request->session('admin')->flush();
        return redirect('admin/login');
    }
    // view dashboard
    protected function getDashboard(){
        return view('admin.dashboard');
    }
    // sitter
    public function getSitters(){
        $data['sitters']=Sitters::all();
        return view('admin.sitters.view-sitters',$data);
    }
    //


    //parents
    public function getParents(){
        $data['parents']=Parents::all();
        return view('admin.parents.view-parents',$data);
    }
}
