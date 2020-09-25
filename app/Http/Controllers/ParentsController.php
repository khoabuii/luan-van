<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentsController extends Controller
{
    //
    public function getIndex(){
        return view('parents.index');
    }
    public function getRegister(){
        $data['address']=Province::all();
        return view('parents.login',$data);
    }
    //register
    public function postRegister(Request $request){
        $this->validate($request,[
            'email'=>'unique:parents,email',
            're-password'=>'same:password'
        ],[
            'email.unique'=>'Email đã tồn tại'
        ]);
        $parent=new Parents();
        $parent->name=$request->name;
        $parent->birthDay=$request->birthDay;
        $parent->email=$request->email;
        $parent->password=bcrypt($request->password);
        $parent->phone=$request->phone;
        // address
        $province=$request->provinces;
        $province=DB::table('provinces')->where('id',$province)->select('name')->get();

        $district=$request->districts;
        $district=DB::table('districts')->where('id',$district)->select('name')->get();

        $ward=$request->wards;
        $ward=DB::table('wards')->where('id',$ward)->select('name')->get();

        $address=''.$ward[0]->name.', '.$district[0]->name.', '.$province[0]->name.'';
        $parent->address=$address;

        $parent->description=$request->description;
        $parent->save();

        return redirect('/parent/login')->with('success','Đăng ký thành công, vui lòng đăng nhập');
    }
    // post login
    public function postLogin(Request $request){
        $arr=['email'=>$request->email,'password'=>$request->password];
        if(Auth::guard('parents')->attempt($arr)){
            return redirect('/parent');
        }else{
            return back()->with('error','Đăng nhập sai');
        }
    }

    //logout
    public function logout(Request $request){
        Auth::guard('parents')->logout();
        if (!Auth::check() && !Auth::guard('parents')->check()) {
            $request->session()->flush();
            $request->session()->regenerate();
        }
        return redirect('/parent/login');
    }
    // view profile
    public function getProfile(){
        return view('parents.profile.profile');
    }
}
