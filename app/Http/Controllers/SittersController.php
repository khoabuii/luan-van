<?php

namespace App\Http\Controllers;

use App\feedback_parent;
use App\img_sitter;
use App\Location;
use App\Parents;
use App\Province;
use App\save_post;
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
        $id_sitter=Auth::user()->id;
        $your_province=Location::where('sitter',$id_sitter)->select('city','address')->get();

        $data['parent_near']=DB::table('location')
        ->join('parents','location.parent','=','parents.id')
        ->where('city',$your_province[0]->city)
        ->select('parents.id as id','parents.name as name','parents.description','parents.avatar as img','parents.created_at')
        ->orderBy('location.id','desc')->take(8)->get();
        $data['location_name']=Province::where('id',$your_province[0]->city)->select('name')->get();

        return view('sitters.index',$data);
    }
    public function getRegister(){
        if(Auth::user()){
            return redirect('/sitter');
        }
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
        $data['feedback']=DB::table('feedback_sitters')
        ->where('sitter',Auth::user()->id)
        ->join('parents','feedback_sitters.parent','=','parents.id')
        ->select('feedback_sitters.*','parents.id as id_parent','parents.name','parents.avatar')
        ->orderBy('feedback_sitters.id','desc')->paginate(10);
        // dd($data['feedback']);
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

        $save_img_sitter=Sitters::findOrFail($id);
        $save_img_sitter->images=$file;
        $save_img_sitter->save();
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
    public function getParentsList(){
        $data['parents']=DB::table('parents')
        ->join('location','parents.id','=','location.parent')
        ->select('parents.id','parents.name','parents.avatar as img','parents.created_at','location.district','location.city','location.address')
        ->paginate(10);
        return view('sitters.parents_list',$data);
    }

    // parent profile
    public function getParentProfile($id){
        $data['parent']=Parents::find($id);
        $data['location']=DB::table('location')
        ->where('parent',$id)->get();

        //feedback
        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',$id)
        ->select('feedback_parents.*','sitters.name','sitters.images')
        ->get();
        // dd($data['feedback']);
        $data['check_feedback']=DB::table('feedback_parents')
        ->where('sitter',Auth::user()->id)
        ->where('parent',$id)->get();
        // dd($data['check_feedback']);
        return view('sitters.parent_profile',$data);
    }
    // post feedback parent profile
    public function postFeedbackParent(Request $request,$id_parent){
        $id_sitter=Auth::user()->id;
        $check=DB::table('feedback_parents')
        ->where('sitter',$id_sitter)->where('parent',$id_parent)
        ->select('id')
        ->get();
        if(count($check)>0){
            $feedback=feedback_parent::find($check[0]->id);
            $feedback->parent=$id_parent;
            $feedback->sitter=$id_sitter;
            $feedback->rate_parent=$request->star;
            $feedback->content_parent=$request->description;
            $feedback->save();
            return redirect('sitter/parent_profile/'.$id_parent.'/#feedback_parent');
        }
        $feedback=new feedback_parent();
        $feedback->parent=$id_parent;
        $feedback->sitter=$id_sitter;
        $feedback->rate_parent=$request->star;
        $feedback->content_parent=$request->description;

        $feedback->save();

        return redirect('sitter/parent_profile/'.$id_parent.'/#feedback_parent');
    }
    // posts list by parents
    public function getPostsList(){
        $data['posts']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.name','parents.avatar')
        ->orderBy('posts.id','desc')
        ->paginate(15);
        $data['check_user']=DB::table('save_posts')
        ->where('sitter',Auth::user()->id)->get();
        // dd($data['check_user']);
        return view('sitters.posts_list',$data);
    }
    // save post id
    public function getSavePostId($id){
        $id_sitter=Auth::user()->id;
        $check=DB::table('save_posts')
        ->where('sitter',$id_sitter)->where('post',$id)->get();
        if($check ==null){
            $save=new save_post();
            $save->post=$id;
            $save->sitter=$id_sitter;
            $save->save();
            return back()->with('save','bạn đã lưu thành công');
        }else
        return back();
    }
    // get save post list
    public function getSaveList(){
        $data['save_list']=DB::table('save_posts')
        ->where('sitter',Auth::user()->id)
        ->join('posts','save_posts.post','=','posts.id')
        ->join('parents','posts.parent','=','parents.id')
        ->select('save_posts.id as id_save_post','posts.id as id_post','posts.title','posts.content','posts.created_at','posts.images','parents.id as id_parent','parents.name as parent_name','parents.avatar')
        ->orderBy('save_posts.id','desc')->paginate(15);
        return view('sitters.save_list',$data);
    }
    // get getSaveDelete
    public function getSaveDelete($id){
        save_post::destroy($id);
        return back()->with('success','Bạn đã xóa thành công');
    }
}
