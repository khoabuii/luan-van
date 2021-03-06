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
use App\Skill;
use App\User;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\Doctrine\CarbonType;
use OneSignal;
use Barryvdh\DomPDF\Facade as PDF;
class AdminController extends Controller
{
    //
    function getLogin(){
        return view('admin.admin_login');
    }
    public function postLogin(Request $request){
        $email=$request->email;
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
        $data['posts']=Post::all();

        $data['posts_parents']=Post::where('parent')->get();
        $data['posts_sitters']=Post::where('sitter')->get();

        $firstDateMonth="2018-1-1";
        $nowDate=Carbon::now()->toDateString();

        $data['sitters_now']=Sitters::whereBetween('created_at',[$firstDateMonth,$nowDate])
            ->get();
        $data['parents_now']=Parents::whereBetween('created_at',[$firstDateMonth,$nowDate])->get();
        return view('admin.dashboard',$data);
    }
    // sitter
    public function getSitters(){
        $data['sitters']=Sitters::all();
        return view('admin.sitters.view-sitters',$data);
    }
    // create pdf sitter
    public function createPDFListSitter(){
        $data['sitters']=Sitters::all();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    	$pdf = PDF::loadView('pdf.sitters',$data);
    	return $pdf->download('ds_bao_mau.pdf');
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

    // export pdf parent
    public function createPDFParent(){
        $data['parents']=DB::table('parents')
        ->join('location','parents.id','=','location.parent')
        ->select('parents.*','location.address as add_current')->get();
        $pdf = PDF::loadView('pdf.parents',$data);
    	return $pdf->download('ds_phu_huynh.pdf');
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
        $data['parents']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.id as id_parent','parents.name as parent_name','parents.avatar as parent_img')
        ->orderByDesc('posts.id')
        ->get();

        $data['sitters']=DB::table('posts')
        ->join('sitters','posts.sitter','=','sitters.id')
        ->select('posts.*','sitters.id as id_sitter','sitters.name as sitter_name','sitters.images as sitter_img')
        ->orderByDesc('posts.id')
        ->get();

        $posts=array();
        $posts=array_merge($data['parents']->toArray(),$data['sitters']->toArray());
        $data['posts']=$posts;

        return view('admin.posts.view-posts',$data);
    }
    // create pdf file posts
    public function createPDFPosts(){
        $data['parents']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.id as id_parent','parents.name as parent_name','parents.avatar as parent_img')
        ->orderByDesc('posts.id')
        ->get();

        $data['sitters']=DB::table('posts')
        ->join('sitters','posts.sitter','=','sitters.id')
        ->select('posts.*','sitters.id as id_sitter','sitters.name as sitter_name','sitters.images as sitter_img')
        ->orderByDesc('posts.id')
        ->get();

        $posts=array();
        $posts=array_merge($data['parents']->toArray(),$data['sitters']->toArray());
        $data['posts']=$posts;

        $pdf = PDF::loadView('pdf.posts',$data);
    	return $pdf->download('ds_bai_viet.pdf');
    }

    // delete posts
    public function deletePost($id){
        $this->deletePostParent($id);
        return back()->with('delete','Đã xóa bài viết thành công');
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
// CREATE PDF FILE CONTRACTS
    public function createPDFContracts(){
        $data['contracts']=DB::table('contracts')
        ->join('sitters','contracts.sitter','=','sitters.id')
        ->join('parents','contracts.parent','=','parents.id')
        ->select('contracts.*','parents.id as id_parent','parents.name as name_parent','parents.avatar as avatar_parent','sitters.id as id_sitter','sitters.name as name_sitter','sitters.images as avatar_sitter')
        ->get();
        $pdf=PDF::loadView('pdf.contracts',$data);
        return $pdf->download('ds_hop_dong.pdf');
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
        //send mail for all users
        if(\Request::is('admin/message')){
            Mail::send('admin.message.mail_content', $data, function ($message) use ($email,$subject) {
                $message->from('khoab1606808@gmail.com', 'Khoa Bui');

                $message->cc($email);
                $message->subject($subject);
            });
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
    public function notiToAll(){
        OneSignal::sendNotificationToAll(
            "Some Message",
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
        return "";
    }
    // show view manager skill
    public function showSkill(){
        $data['skills']=Skill::all();
        return view('admin.sitters.skill',$data);
    }
    //add skill
    public function addSkill(Request $request){
        $skill=new Skill();
        $this->validate($request,[
            'name'=>'unique:skill,name'
        ],[
            'name.unique'=>'Skill bị trùng'
        ]);
        $skill->name=$request->name;
        $skill->save();
        return back()->with('success','Đã thêm thành công');
    }
    // delete skill
    public function deleteSkill($id){
        Skill::destroy($id);
        return back()->with('success','Đã xóa thành công');
    }
}
