<?php

namespace App\Http\Controllers;

use App\img_sitter;
use App\Location;
use App\Province;
use App\Sitters;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysqli;
use Illuminate\Support\Facades\Storage;

class SittersController extends Controller
{
    //
    public function getIndex(){
        return view('sitters.index');
    }
    public function getRegister(){
        $data['address']=Province::all();
        return view('sitters.login',$data);
    }
    // post register
    public function postRegister(Request $request){
        $this->validate($request,[
            'email'=>'unique:sitters,email',
            're-password'=>'same:password'
        ],[
            'email.unique'=>'Email đã tồn tại'
        ]);
        $sitter=new Sitters();
        $sitter->name=$request->name;
        $sitter->birthDay=$request->birthDay;
        $sitter->email=$request->email;
        $sitter->gender=$request->gender;
        $sitter->phone=$request->phone;
        $sitter->education=$request->education;
        $sitter->password=bcrypt($request->password);

        $sitter->status=0;
        // address
        $province=$request->provinces;
        $province=DB::table('provinces')->where('id',$province)->select('name')->get();

        $district=$request->districts;
        $district=DB::table('districts')->where('id',$district)->select('name')->get();

        $ward=$request->wards;
        $ward=DB::table('wards')->where('id',$ward)->select('name')->get();

        $address=''.$ward[0]->name.', '.$district[0]->name.', '.$province[0]->name.'';
        $sitter->address=$address;

        $sitter->description=$request->description;

        $sitter->save();
        return redirect('/sitter/login')->with('success','Đăng ký thành công, xin mời đăng nhập tại đây');
    }
    public function postLogin(Request $request){
        // error
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect('/sitter');
        }
        return back()->with('error','Đăng nhập thất bại');
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect('/sitter/login');
    }
// profile
    public function getProfile(){
        $data['img']=img_sitter::where('sitter_id',Auth::user()->id)->select('img')->get();
        $data['address']=Province::all();
        $data['location']=Location::where('sitter',Auth::user()->id)->select('address')->get();
        // dd($data['location']);
        return view('sitters.profile.profile',$data);
    }
    //update profile
    public function getUpdateProfile(){
        $id=Auth::user()->id;
        $data['address']=Province::all();
        return view('sitters.profile.update',$data);
    }
    // post update images
    public function postImagesProfile(Request $request){
        $id=Auth::user()->id;
        $img=new img_sitter();
        $img->sitter_id=$id;
        $file=request()->file('image');
        $file=$file->store('sitters_profile',['disk'=>'uploads']);
        $file=substr($file,16);
        $img->img=$file;
        $img->save();
        return back();
    }
    public function getDeleteImageProfile($id){
        img_sitter::where('img',$id)->delete();
        return back()->with('delete','Đã xóa hình ảnh');
    }

    // update location
    public function postLocationUpdate(Request $request){
        $location=new Location();
        $sitter_id=Auth::user()->id;
        $city=$request->provinces;
        $district=$request->districts;
        $ward=$request->wards;

        $check_address=Location::where('sitter',$sitter_id)->get();
        if(count($check_address)>0){
            Location::where('sitter',$sitter_id)->delete();
        }

        $city_name=DB::table('provinces')->where('id',$city)->select('name')->get();
        $district_name=DB::table('districts')->where('id',$district)->select('name')->get();
        $ward_name=DB::table('wards')->where('id',$ward)->select('name')->get();
        $address=''.$ward_name[0]->name.', '.$district_name[0]->name.', '.$city_name[0]->name.'';

        $location->sitter=$sitter_id;
        $location->address=$address;
        $location->ward=$ward;
        $location->district=$district;
        $location->city=$city;

        $location->save();
        return back()->with('update','Đã cập nhật vị trí');
    }
}
