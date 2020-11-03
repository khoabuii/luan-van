<?php

namespace App\Http\Controllers;

use App\Contract;
use App\feedback_parent;
use App\feedback_sitter;
use App\Location;
use App\Parents;
use App\Plan;
use App\Post;
use App\Sitters;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;
use App\Mail\TestMail;

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
        // $password=md5($request->email);
        $password='827ccb0eea8a706c4c34a16891f84e7b';
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
        $data['sitters']=Sitters::all();
        $data['parents']=Parents::all();
        $data['contracts']=Contract::all();
        return view('admin.dashboard',$data);
    }
    // sitter
    public function getSitters(){
        $data['sitters']=Sitters::all();
        return view('admin.sitters.view-sitters',$data);
    }
    // detail sitter
    public function getDetailSitter($id){
        $data['sitter']=Sitters::findOrFail($id);
        $data['address']=Location::where('sitter',$id)->get();

        $data['feedback']=DB::table('feedback_sitters')
        ->join('parents','feedback_sitters.parent','=','parents.id')
        ->where('sitter',$id)
        ->select('feedback_sitters.*','parents.id as id_parent','parents.name','parents.avatar')
        ->orderBy('id','desc')
        ->get();

        $data['activity']=Plan::where('sitter',$id)->get();
        return view('admin.sitters.detail-sitter',$data);
    }
    // delete feedback sitter
    public function deleteFeedbackSitter($id){
        $id_sitter=feedback_sitter::find($id)->sitter;
        feedback_sitter::destroy($id);
        return redirect('admin/sitters/detail/'.$id_sitter.'#feedback');
    }
    //delete sitters
    public function getDeleteSitter($id){
        Sitters::destroy($id);
        return back()->with('success','Thao tác thành công');
    }
    // active sitter
    public function activeSitter($id){
        $sitter=Sitters::find($id);
        $sitter->status=1;
        $sitter->save();

        return response()->json(array('success'=>true));
    }
    // cancel active sitter
    public function cancelActiveSitter($id){
        $sitter=Sitters::find($id);
        $sitter->status=0;
        $sitter->save();

        return response()->json(array('success'=>true));
    }

    //parents
    public function getParents(){
        $data['parents']=DB::table('parents')
        ->join('location','parents.id','=','location.parent')
        ->select('parents.*','location.address as add_current')->get();
        return view('admin.parents.view-parents',$data);
    }
    // detail parent
    public function getDetailParent($id){
        $data['parent']=Parents::findOrFail($id);
        $data['location']=Location::where('parent',$id)->get();
        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',$id)
        ->select('feedback_parents.*','sitters.id as id_sitter','sitters.name','sitters.images as avatar')
        ->orderBy('id','desc')
        ->get();

        $data['activity']=Plan::where('parent',$id)->get();

        $data['posts']=Post::where('parent',$id)->get();
        return view('admin.parents.detail-parent',$data);
    }
    // delete profile parent
    public function getDeleteParent($id){
        Parents::destroy($id);
        return back()->with('success','Thao tác thành công');
    }
    // delete feedback
    public function deleteFeedbackParent($id){
        $id_parent=feedback_parent::find($id)->parent;
        feedback_parent::destroy($id);
        return redirect('admin/parents/detail/'.$id_parent.'#feedback');
    }
    // delete post parent
    public function deletePostParent($id){
        $id_parent=Post::find($id)->parent;
        Post::destroy($id);
        $url = url()->current();
        if($url=='https://khoabui.dev/admin/posts'){
            return back();
        }else
            return redirect('admin/parents/detail/'.$id_parent.'#posts');
    }
    // view all post parent
    public function allPost(){
        $data['posts']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.id as id_parent','parents.name','parents.avatar')
        ->get();
        return view('admin.posts.view-posts',$data);
    }
    // contracts
    public function getContracts(){
        $data['contracts']=DB::table('contracts')
        ->join('sitters','contracts.sitter','=','sitters.id')
        ->join('parents','contracts.parent','=','parents.id')
        ->select('contracts.*','parents.id as id_parent','parents.name as name_parent','parents.avatar as avatar_parent','sitters.id as id_sitter','sitters.name as name_sitter','sitters.images as avatar_sitter')
        ->get();
        return view('admin.contracts.view-contracts',$data);
    }
    // delete contract
    public function deleteContract($id){
        Contract::destroy($id);
        return back()->with('success','Bạn đã xóa thành công');
    }

    // send email message
    public function getMessage(){
        if(\Request::is('admin/message')){
            return view('admin.message.send_all');
        }
        elseif(\Request::is('admin/message/parents')){
            return view('admin.message.send_parent');
        }
        elseif(\Request::is('admin/message/sitters')){
            return view('admin.message.send_sitter');
        }
    }
    //post send email
    public function postMessage(Request $request){
        $data['content']=$request->content;
        $subject=$request->subject;
        $sitter=Sitters::pluck('email')->toArray();
        $parent=Parents::pluck('email')->toArray();

        $email=array_merge($sitter,$parent);

        $test=['myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com'];
        // dd($email);
        //send mail for all users
        if(\Request::is('admin/message')){
            Mail::send('admin.message.mail_content', $data, function ($message) use ($email,$subject) {
                $message->from('khoab1606808@gmail.com', 'Khoa Bui');

                $message->cc($email);
                $message->subject($subject);
            });
            // var_dump(Mail::failures());
            // exit;
            return back()->with('success','Bạn đã thông báo qua mail cho tất cả thành viên trong hệ thống');
        }
        // send mail for parents users
        elseif(\Request::is('admin/message/parents')){
            Mail::send('admin.message.mail_content', $data, function ($message) use ($sitter,$subject) {
                $message->from('khoab1606808@gmail.com', 'Khoa Bui');
                $message->cc($sitter);
                $message->subject($subject);
            });
            return back()->with('success','Bạn đã thông báo qua email cho tất cả người dùng phụ huynh');
        }
        //send mail for sitters users
        elseif(\Request::is('admin/message/sitters')){
            Mail::send('admin.message.mail_content', $data, function ($message) use ($parent,$subject) {
                $message->from('khoab1606808@gmail.com', 'Khoa Bui');
                $message->cc($parent);
                $message->subject($subject);
            });
            return back()->with('success','Bạn đã thông báo qua email cho tất cả người dùng bảo mẫu');
        }
        return false;
    }
}
