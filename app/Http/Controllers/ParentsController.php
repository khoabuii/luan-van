<?php

namespace App\Http\Controllers;

use App\feedback_sitter;
use App\img_sitter;
use App\Location;
use App\Parents;
use App\Province;
use App\save_sitters;
use App\Sitters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentsController extends Controller
{
    //
    public function getIndex(){
        $id_parent=Auth::guard('parents')->user()->id;
        $your_province=Location::where('parent',$id_parent)->select('city','address')->get();
        $data['sitters_id']=Location::where('city',$your_province[0]->city)->select('sitter')->get();
        $data['sitters_near']=DB::table('location')
        ->join('sitters','location.sitter','=','sitters.id')
        ->where('city',$your_province[0]->city)
        ->select('sitters.id as id','sitters.name as name','sitters.gender','sitters.status as status','sitters.description','sitters.images as img')
        ->orderBy('location.id','desc')->take(8)->get();
        $data['location_name']=Province::where('id',$your_province[0]->city)->select('name')->get();
        return view('parents.index',$data);
    }
    public function getRegister(){
        // if(Auth::guard('parents')){
        //     return redirect('/parent');
        // }
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
        $data['address']=Province::all();
        $data['location']=Location::where('parent',Auth::guard('parents')->user()->id)->select('address')->get();
        return view('parents.profile.profile',$data);
    }
    public function postImageUpdate(Request $request){
        $id_parent=Auth::guard('parents')->user()->id;
        $img=parents::findOrFail($id_parent);

        $file=request()->file('image');
        $file=$file->store('parents_profile',['disk'=>'uploads']);
        $file=substr($file,16);
        $img->avatar=$file;
        $img->save();
        return back();
    }
    public function postLocationUpdate(Request $request){
        $location=new Location();
        $parent_id=Auth::guard('parents')->user()->id;
        $city=$request->provinces;
        $district=$request->districts;
        $ward=$request->wards;

        $check_address=Location::where('parent',$parent_id)->get();
        if(count($check_address)>0){
            Location::where('parent',$parent_id)->delete();
        }

        $city_name=DB::table('provinces')->where('id',$city)->select('name')->get();
        $district_name=DB::table('districts')->where('id',$district)->select('name')->get();
        $ward_name=DB::table('wards')->where('id',$ward)->select('name')->get();
        $address=''.$ward_name[0]->name.', '.$district_name[0]->name.', '.$city_name[0]->name.'';

        $location->parent=$parent_id;
        $location->address=$address;
        $location->ward=$ward;
        $location->district=$district;
        $location->city=$city;

        $location->save();
        return back()->with('update','Đã cập nhật vị trí');
    }
    // get sitter profile
    public function getSitterProfile($id){
        $id_sitter=$id;
        $id_parent=Auth::guard('parents')->user()->id;
        $data['check']=save_sitters::where('parent',$id_parent)
        ->where('sitter',$id_sitter)->get();

        $data['sitter']=Sitters::findOrFail($id);
        $data['img_sitter']=img_sitter::where('sitter_id',$id)->select('img')->get();
        $data['location']=Location::where('sitter',$id)->get();

        //feedback
        $data['feedback']=DB::table('feedback_sitters')
        ->join('parents','feedback_sitters.parent','=','parents.id')
        ->where('sitter',$id_sitter)
        ->select('feedback_sitters.*','parents.id as id_parent','parents.name','parents.avatar')
        ->orderBy('id','desc')
        ->get();

        $data['check_feedback']=DB::table('feedback_sitters')
        ->where('sitter',$id_sitter)->where('parent',$id_parent)->get();
        // dd($data['check_feedback']);
        return view('parents.sitter_profile',$data);
    }
    //getListSitters
    public function getListSitters(){
        $data['sitters']=DB::table('sitters')
        ->join('location','sitters.id','=','location.sitter')
        ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
        ->orderBy('sitters.id','desc')
        ->paginate(10);
        return view('parents.list_sitters',$data);
    }
    //get Save Sitters
    public function getSaveSitters(){
        $data['save_list']=DB::table('save_sitters')
        ->where('parent',Auth::guard('parents')->user()->id)
        ->join('sitters','save_sitters.sitter','=','sitters.id')
        ->select('save_sitters.*','sitters.id as id_sitter','sitters.name','sitters.images')
        ->orderBy('id','desc')->get();
        return view('parents.save_sitters',$data);
    }
    public function getSaveSittersId($id){
        $id_sitter=$id;
        $id_parent=Auth::guard('parents')->user()->id;
        $check=save_sitters::where('parent',$id_parent)
        ->where('sitter',$id_sitter)->get();
        if(count($check)>0){
            return back()->with('success','Người này đã tồn tại trong danh sách đã lưu');
        }
        $save_sitter=new save_sitters();
        $save_sitter->parent=$id_parent;
        $save_sitter->sitter=$id_sitter;
        $save_sitter->save();

        return back()->with('success','Đã lưu thành công');
    }
    // get delete save sitter
    public function getDeleteSaveSitter($id){
        save_sitters::destroy($id);
        return back()->with('success','Bạn đã xóa thành công');
    }

    // post rate sitters profile
    public function postRateSitter(Request $request,$id){
        $id_sitter=$id;
        $id_parent=Auth::guard('parents')->user()->id;
        $check=DB::table('feedback_sitters')
        ->where('sitter',$id_sitter)->where('parent',$id_parent)
        ->select('id')
        ->get();
        if(count($check)>0){
            $feedback=feedback_sitter::find($check[0]->id);
            $feedback->parent=$id_parent;
            $feedback->sitter=$id_sitter;
            $feedback->rate_sitter=$request->star;
            $feedback->content_sitter=$request->description;
            $feedback->save();
            return redirect('parent/sitter_profile/'.$id_sitter.'/#feedback_sitter');
        }
        $feedback=new feedback_sitter();
        $feedback->parent=$id_parent;
        $feedback->sitter=$id_sitter;
        $feedback->rate_sitter=$request->star;
        $feedback->content_sitter=$request->description;

        $feedback->save();

        return redirect('parent/sitter_profile/'.$id_sitter.'/#feedback_sitter');
    }
    // posts
    public function getPostsList(){
        return view('parents.posts.posts_list');
    }
    // post add
    public function postAddPost(Request $request){

    }
}
