<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Contract;
use App\feedback_parent;
use App\img_sitter;
use App\Location;
use App\Parents;
use App\Plan;
use App\Post;
use App\Province;
use App\save_post;
use App\Sitters;
use App\PasswordReset;
use App\Notifications\ResetPasswordRequest;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use OneSignal;
use mysqli;
use Illuminate\Support\Facades\Storage;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use Maatwebsite\Excel\Concerns\ToArray;

class SittersController extends Controller
{
    //
    public function getIndex(){
        $data['id_sitter']=Auth::user()->id;
        $data['your_province']=Location::where('sitter',$data['id_sitter'])->select('city','address')->get();
        $data['location_name']=Province::where('id',$data['your_province'][0]->city)->select('name')->get();
        if(count($data['your_province']) !=0){
            $data['parent_near']=DB::table('location')
            ->join('parents','location.parent','=','parents.id')
            ->where('city',$data['your_province'][0]->city)
            ->select('parents.id as id','parents.name as name','parents.description','parents.avatar as img','parents.created_at')
            ->orderBy('location.id','desc')->take(8)->get();
            return view('sitters.index',$data);
        }
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
        $sitter->money=$request->money;
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

        $data['activity']=Plan::where('sitter',Auth::user()->id)->get();
        return view('sitters.profile.profile',$data);
    }
    //update profile
    public function getUpdateProfile(){
        $id=Auth::user()->id;
        $data['address']=Province::all();
        return view('sitters.profile.update',$data);
    }
    // post update profile
    public function postUpdateProfile(Request $request){
        $id=Auth::user()->id;
        $sitter=Sitters::find($id);

        $sitter->name=$request->name;
        $sitter->birthDay=$request->birthDay;
        $sitter->gender=$request->gender;
        $sitter->education=$request->education;
        $sitter->money=$request->money;
        $sitter->address=$request->address;

        // dd($request->changePassword);
        // change password
        if($request->changePassword !=null){
            $sitter->password=bcrypt($request->re_new_password);
        }
        $sitter->description=$request->description;

        $file=request()->file('images');
        if($file !=null){
            $file=$file->store('sitters_profile',['disk'=>'uploads']);
            $file=substr($file,16);
            $sitter->images=$file;

            $img=new img_sitter();
            $img->sitter_id=$id;
            $img->img=$file;

            $img->save();
        }
        $sitter->save();

        return redirect('sitter/profile');
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
    // update work time
    public function updateWorkTime(Request $request){
        $sitter=Auth::user()->id;
        $plan=new Plan();
        $plan->sitter=$sitter;
        // time
        $check_plan=DB::table('plans')->where('sitter',$sitter)->get();
        if(count($check_plan)==0){
            $plan->session1=$request->time1;
            $plan->session2=$request->time2;
            $plan->session3=$request->time3;
            $plan->session4=$request->time4;
            $plan->session5=$request->time5;
            $plan->session6=$request->time6;
            $plan->session7=$request->time7;
            $plan->session8=$request->time8;
            $plan->session9=$request->time9;
            $plan->session10=$request->time10;
            $plan->session11=$request->time11;
            $plan->session12=$request->time12;
            $plan->session13=$request->time13;
            $plan->session14=$request->time14;
            $plan->save();
            return redirect('sitter/profile#action');
        }else{
            $plan=Plan::find($check_plan[0]->id);

            $plan->session1=$request->time1;
            $plan->session2=$request->time2;
            $plan->session3=$request->time3;
            $plan->session4=$request->time4;
            $plan->session5=$request->time5;
            $plan->session6=$request->time6;
            $plan->session7=$request->time7;
            $plan->session8=$request->time8;
            $plan->session9=$request->time9;
            $plan->session10=$request->time10;
            $plan->session11=$request->time11;
            $plan->session12=$request->time12;
            $plan->session13=$request->time13;
            $plan->session14=$request->time14;
            $plan->save();
            return redirect('sitter/profile#action');
        }
        return false;
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
    // list parent
    public function getParentsList(){
        $data['location']=Province::all();
        $data['parents']=DB::table('parents')
            ->join('location','parents.id','=','location.parent')
            ->select('parents.id','parents.name','parents.avatar as img','parents.created_at','location.district','location.city','location.address')
            ->paginate(10);
        return view('sitters.parents_list',$data);
    }
    public function searchParent(Request $request){
        $data['location']=Province::all();
        $name=$request->name;
        $province_id=$request->province;
        $name=str_replace('','%',$name);
        if($province_id =="0"){
            $data['parents']=DB::table('parents')->where('name','like','%'.$name.'%')
            ->join('location','parents.id','=','location.parent')
            ->select('parents.id','parents.name','parents.avatar as img','parents.created_at','location.district','location.city','location.address')
            ->orderBy('parents.id','desc')
            ->paginate(10);
        return view('sitters.parents_list',$data);

        }else{
            $data['parents']=DB::table('parents')
                ->join('location','parents.id','=','location.parent')
                ->select('parents.id','parents.name','parents.avatar as img','parents.created_at','location.district','location.city','location.address')
                ->orderBy('parents.id','desc')
                ->where('parents.name','like','%'.$name.'%')
                ->where('location.city','like',$province_id)
                ->paginate(10);
            return view('sitters.parents_list',$data);
            }
    }
    // parent profile
    public function getParentProfile($id){
        $data['parent']=Parents::find($id);
        $data['location']=DB::table('location')
        ->where('parent',$id)->get();

        // view feedback
        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',$id)
        ->select('feedback_parents.*','sitters.name','sitters.images')
        ->get();

        $data['check_feedback']=DB::table('feedback_parents')
        ->where('sitter',Auth::user()->id)
        ->where('parent',$id)->get();

        $data['check_is_contract']=DB::table('contracts')
            ->where([
                'parent'=>$id,
                'sitter'=>Auth::user()->id,
                'status'=>0||1
            ])->get();

        $data['activity']=Plan::where('parent',$id)->get();

        if(count($data['feedback'])!=0){
            $rate_parent=DB::table('feedback_parents')
            ->where('parent',$id)
            ->groupBy('parent')
            ->selectRaw('sum( rate_parent) as sum')
            ->get('sum');

            $data['avg_rate']=$rate_parent->sum('sum')/count($data['feedback']);
        }
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

    // delete feedback
    public function deleteFeedback($id){
        feedback_parent::destroy($id);
        // dd($id);
        return response()->json(array('success'=>true));
    }

    // posts list by parents
    public function getPostsList(){
        $data['parents']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.name as parent_name','parents.avatar as parent_avatar')
        ->orderBy('posts.id','desc')
        ->get();

        $data['sitters']=DB::table('posts')
        ->join('sitters','posts.sitter','=','sitters.id')
        ->select('posts.*','sitters.name as sitter_name','sitters.images as sitter_avatar')
        ->orderBy('posts.id','desc')
        ->get();

        $posts=array();
        $posts=array_merge($data['parents']->toArray(),$data['sitters']->toArray());
        $data['posts']=$posts;

        $data['check_user']=DB::table('save_posts')
        ->where('sitter',Auth::user()->id)->get();

           // comments
           $comments['parents']=DB::table('comments')
           ->join('sitters','sitters.id','=','comments.sitter')
           ->select('comments.*','sitters.name as sitter_name')->get();

           $comments['sitters']=DB::table('comments')
           ->join('parents','parents.id','=','comments.parent')
           ->select('comments.*','parents.name as parent_name')->get();

           $data['comments']=array_merge($comments['parents']->toArray(),$comments['sitters']->toArray());
        return view('sitters.posts_list',$data);
    }
     // comment of post parent
    public function postComment($id, Request $request){
        $comment=new Comment();
        $comment->posts=$id;
        $comment->sitter=Auth::user()->id;
        $comment->content=$request->content;
        $comment->save();

        // return response()->json(array(['success'=>true]));
        return back()->with('success','Bình luận đã được gửi');
    }
    // add post
    public function addPost(Request $request){
        $this->validate($request,[
            'title'=>'min:5',
            'image'=>'image'
        ],[
            'title.min'=>'Tiêu đề tối thiểu 5 kí tự',
            'image.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->sitter=Auth::user()->id;
        $file=request()->file('image');
        if($file !=null){
            $file=$file->store('posts',['disk'=>'uploads']);
            $file=substr($file,6);
        }

        $post->images=$file;
        $post->content=$request->description;
        $post->save();

        return back()->with('success','Bạn đã đăng thành công');
    }
    public function parentPosts($id){
        $data['parent']=DB::table('parents')->where('id',$id)->get();
        $data['posts']=DB::table('posts')
            ->where('parent',$id)
            ->get();
        return view('sitters.parent_posts',$data);
    }
    // my posts
    public function myPosts(){
        $data['posts']=DB::table('posts')->where('sitter',Auth::user()->id)->get();
        return view('sitters.myPosts',$data);
    }

    // save post id
    public function getSavePostId($id){
        $id_sitter=Auth::user()->id;
        $check=DB::table('save_posts')
        ->where('sitter',$id_sitter)->where('post',$id)->get();
        if(count($check) ==0){
            $save=new save_post();
            $save->post=$id;
            $save->sitter=$id_sitter;
            $save->save();
            return back()->with('save','bạn đã lưu thành công');
        }else{
            return back();
        }
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
    // get contract
    public function getContracts(){
        $data['contracts']=DB::table('contracts')
        ->where('sitter',Auth::user()->id)
        ->join('sitters','contracts.sitter','=','sitters.id')
        ->join('parents','contracts.parent','=','parents.id')
        ->select('contracts.*','sitters.name as sitter_name','sitters.images as sitter_img','parents.name as parent_name','parents.avatar as parent_img')
        ->get();
        // dd($data);
        return view('sitters.profile.contracts',$data);
    }

    //send contract parent
    public function sendRequestContractParent($id){
        $contract=new Contract();
        $contract->parent=$id;
        $contract->sitter=Auth::user()->id;
        $parent=Parents::findOrFail($id);
        $description=" Bên A: ".Auth::user()->name."(có ID người dùng: ".Auth::user()->id.") là ngưởi gửi yêu cầu làm việc với bên B
        Bên B: ".$parent->name."( có ID người dùng: <b>".$parent->id.") sẽ xem yêu cầu kí kết hợp đồng
        Giá: ".number_format(Auth::user()->money)." VND/Buổi (Có thể tự thỏa thuận)
        Chúng tôi chỉ cung cấp nền tảng, mọi vấn đề xảy ra chúng tôi sẽ không chịu trách nhiệm.";

        $contract->money=Auth::user()->money;
        $contract->check=1;
        $contract->description=$description;
        $contract->status=0;

        $check_is_sent=DB::table('contracts')
            ->where([
                'parent'=>$id,
                'sitter'=>Auth::user()->id,
                'status'=>0
            ])->get();
        if(count($check_is_sent)!=0){
            return back()->with('errors','Gửi yêu cầu không thành công. Có thể do bạn đã thực hiện yêu cầu hoặc có 1 vấn đề nào đó');
        }
        $contract->save();
        // content data mail send parent
        $data['sitter_name']=Auth::user()->name;
        $data['sitter_id']=Auth::user()->id;
        $data['money']=Auth::user()->money;
        $data['description']=$description;
        $email=$parent->email;
        // send mail confirm to parent
        Mail::send('sendMailParent',$data, function ($message) use($email) {
            $message->from('khoab1606808@gmail.com', 'Khoa Bui');

            $message->to($email);

            $message->subject('Xác nhận yêu cầu kí kết làm việc');
        });
        return redirect('/sitter')->with('success','Đã gửi yêu cầu thành công');
    }
    // accept contract
    public function acceptContract($id){
        $contract=Contract::find($id);
        $contract->status=1;
        $contract->save();

        return response()->json(array('success'=>true));
    }
    // cancel contract
    public function cancelContract($id){
        $contract=Contract::find($id);
        $contract->status=2;
        $contract->save();

        return response()->json(array('success'=>true));
    }

    // chat
    public function getChat(){
        $data['parents']=Parents::all();
        return view('sitters.chat',$data);
    }
    // show chat
    public function showChatParent($id){
        $data['parents']=Parents::all();
        $data['parent']=Parents::find($id);
        $data['chats']=DB::table('message')
        ->where('sitter',Auth::user()->id)->where('parent',$id)->get();
        return view('sitters.chatId',$data);
    }
    // sent Notification to parent
    public function sentNoti($id){
        $my_id=Auth::user()->id;

        $parent=Parents::find($id);
        $parent_name=$parent->name;
        $sitter=Sitters::find($my_id)->name;

        OneSignal::sendNotificationToAll(
            "Bạn nhận được tin nhắn từ Bảo mẫu ".$sitter." ",
            $url = "/parent/chat/".$my_id."",
            $data = null,
            $buttons = null,
            $schedule = null
        );
        return response()->json(array('success'=>true));
    }

    //delete account
    public function deleteAccount(){
        $id=Auth::user()->id;
        Sitters::destroy($id);
        return redirect('sitter/login')->with('success','Bạn đã xóa tài khoản của mình');
    }

    /////////////// PASSWORD RESET ////////////////////
    public function sendMailToReset(Request $request){
        $email_reset=$request->email_reset;
        $sitter=Sitters::where('email',$email_reset)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $sitter->email,
        ], [
            'token' => Str::random(60),
        ]);

        $token=PasswordReset::where('email',$email_reset)->select('token')->first('token');
        $data['url']=url('sitter/login/reset_password/'.$token->token);
        if ($passwordReset) {
            Mail::send('sendMailPassReset', $data, function ($message)use($email_reset) {

                $message->from('khoab1606808@gmail.com', 'Khoa Bui');

                $message->to($email_reset);

                $message->subject('Khôi phục mật khẩu của bạn');
            });
        }
        return back()->with('pass_reset','Chúng tôi đã gửi mail cho bạn để xác nhận');
    }
    public function resetPassword(Request $request, $token){
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $sitter = Sitters::where('email', $passwordReset->email)->firstOrFail();
        $sitter->password=bcrypt('123456');
        $sitter->save();
        $passwordReset->delete();

        return redirect('sitter/login')->with('pass_reset','Mật khẩu mới của bạn là \n 123456');
    }
}
