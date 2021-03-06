<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Contract;
use App\feedback_sitter;
use App\img_sitter;
use App\Location;
use App\Message;
use App\Parents;
use App\Plan;
use App\Post;
use App\Province;
use App\save_sitters;
use App\Sitters;
use App\PasswordReset;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use OneSignal;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use Maatwebsite\Excel\Concerns\ToArray;

class ParentsController extends Controller
{
    //
    public function getIndex(){
        $data['location']=Province::all();
        if(Auth::guard('parents')->check()){
            $id_parent=Auth::guard('parents')->user()->id;

            $data['your_province']=Location::where('parent',$id_parent)->select('city','address')->get();
            if(count($data['your_province']) !=0){
                $data['sitters_id']=Location::where('city',$data['your_province'][0]->city)->select('sitter')->get();
                $data['sitters_near']=DB::table('location')
                ->join('sitters','location.sitter','=','sitters.id')
                ->where('city',$data['your_province'][0]->city)
                ->select('sitters.id as id','sitters.name as name','sitters.gender','sitters.status as status','sitters.description','sitters.images as img')
                ->orderBy('location.id','desc')->take(8)->get();
                $data['location_name']=Province::where('id',$data['your_province'][0]->city)->select('name')->get();
            }
        }
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
            're-password'=>'same:password',
            'phone'=>'min:9,max:10',
            'birthDay'=>'required|date|before:18 years ago'
        ],[
            'email.unique'=>'Email đã tồn tại',

        ]);
        $parent=new Parents();
        $parent->name=$request->name;
        $parent->birthDay=$request->birthDay;
        $parent->email=$request->email;
        $parent->password=bcrypt($request->password);
        $parent->phone=$request->phone;
        $parent->child=$request->child;
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

        // save location table
        $location= new Location();
        $location->parent=$parent->id;
        $location->address=$parent->address;
        $location->city=$request->provinces;
        $location->district=$request->districts;
        $location->ward=$request->wards;

        $location->save();

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

        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',Auth::guard('parents')->user()->id)
        ->select('feedback_parents.*','sitters.id as id_sitter','sitters.name','sitters.images as avatar')
        ->orderBy('id','desc')
        ->get();

        $data['activity']=Plan::where('parent',Auth::guard('parents')->user()->id)->get();
        return view('parents.profile.profile',$data);
    }
    // view update info
    public function getUpdateInfo(){
        return view('parents.profile.update');
    }
    // post update profile
    public function postUpdateInfo(Request $request){
        $this->validate($request,[
            'new_password'=>'same:re_new_password',
            'images'=>'image'
        ],[
            'new_password.same'=>'Mật khẩu không trùng khớp',
            'images.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $id=Auth::guard('parents')->user()->id;
        $parent=Parents::find($id);

        $parent->name=$request->name;
        $parent->birthDay=$request->birthDay;
        $parent->address=$request->address;

        if($request->changePassword !=null){
            $parent->password=bcrypt($request->re_new_password);
        }
        $parent->description=$request->description;
        $parent->child=$request->child;

        $file=request()->file('images');
        if($file !=null){
            $file=$file->store('parents_profile',['disk'=>'uploads']);
            $file=substr($file,16);
            $parent->avatar=$file;
        }
        $parent->save();

        return redirect('parent/profile');
    }

    ////////////// post update activity ///////////////////////////////
    public function updateWorkTime(Request $request){
        $parent=Auth::guard('parents')->user()->id;
        $plan=new Plan();
        $plan->parent=$parent;
        // time
        $check_plan=DB::table('plans')->where('parent',$parent)->get();
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
            return redirect('parent/profile#action');
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
            return redirect('parent/profile#action');
        }
        return false;
    }
    ///////////// Post update image/////////////////////////////////
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
    //////////////// post update location ////////////////////////////////
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
    /////////////// get sitter profile //////////////////////////////////
    public function getSitterProfile($id){
        $id_sitter=$id;

        $data['sitter']=Sitters::findOrFail($id);
        $data['img_sitter']=img_sitter::where('sitter_id',$id)->select('img')->get();
        $data['location']=Location::where('sitter',$id)->get();

        $data['activity']=Plan::where('sitter',$id_sitter)->get();

        $data['sitter_skill']=DB::table('skill_sitter')
        ->where('sitter',$id_sitter)
        ->join('skill','skill.id','=','skill_sitter.skill')
        ->select('skill.name as name')->get();

        //feedback
        $data['feedback']=DB::table('feedback_sitters')
        ->join('parents','feedback_sitters.parent','=','parents.id')
        ->where('sitter',$id_sitter)
        ->select('feedback_sitters.*','parents.id as id_parent','parents.name','parents.avatar')
        ->orderBy('id','desc')
        ->get();

        if(count($data['feedback'])!=0){
            $rate_sitter=DB::table('feedback_sitters')
            ->where('sitter',$id_sitter)
            ->groupBy('sitter')
            ->selectRaw('sum( rate_sitter) as sum')
            ->get('sum');

            $data['avg_rate']=$rate_sitter->sum('sum')/count($data['feedback']);
        }
        // Auth parent
        if(Auth::guard('parents')->check()){
            $id_parent=Auth::guard('parents')->user()->id;
            $data['check']=save_sitters::where('parent',$id_parent)
            ->where('sitter',$id_sitter)->get();

            $data['check_feedback']=DB::table('feedback_sitters')
            ->where('sitter',$id_sitter)->where('parent',$id_parent)->get();

            $data['contract_pending']=DB::table('contracts')
                ->where([
                    'sitter'=>$id,
                    'parent'=>$id_parent,
                    'status'=>0
                ])->get();

            $data['contract_active']=DB::table('contracts')
            ->where([
                'sitter'=>$id,
                'parent'=>$id_parent,
                'status'=>1
            ])->get();
        }
        // dd($data);
        return view('parents.sitter_profile',$data);
    }
    //////////////////////////// get List Sitters ////////////////////////////////////////////
    public function getListSitters(){
        // $data['province']=Province::find(59)->id;
        $data['location']=Province::all();
        $data['sitters']=DB::table('sitters')
            ->join('location','sitters.id','=','location.sitter')
            ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
            ->orderBy('sitters.id','desc')
            ->paginate(10);
        return view('parents.list_sitters',$data);
    }

    // search sitter
    function searchSitter(Request $request){
        $data['location']=Province::all();
        $name=$request->name;
        $province_id=$request->province;
        $status=$request->status;
        $gender=$request->gender;
        $name=str_replace('','%',$name);
        if($name==null && $province_id==null && $status==null && $gender==null){
            $data['sitters']=DB::table('sitters')->where('name','like','%'.$name.'%')
            ->join('location','sitters.id','=','location.sitter')
            ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
            ->orderBy('sitters.id','desc')
            ->paginate(10);
        }
        elseif($gender !=null && $province_id !=null){
            $data['sitters']=DB::table('sitters')
                ->join('location','sitters.id','=','location.sitter')
                ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
                ->orderBy('sitters.id','desc')
                ->where('sitters.gender','like',(int)$gender)
                ->where('location.city','like',$province_id)
                ->paginate(10);
        }
        elseif($gender !=null ){
            $data['sitters']=DB::table('sitters')
                ->join('location','sitters.id','=','location.sitter')
                ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
                ->orderBy('sitters.id','desc')
                ->where('sitters.gender','like',(int)$gender)
                ->paginate(10);
        }
        elseif($province_id !=null){ // check province and name sitter
            $data['sitters']=DB::table('sitters')
                ->join('location','sitters.id','=','location.sitter')
                ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
                ->orderBy('sitters.id','desc')
                ->where('location.city','like',$province_id)
                ->where('sitters.name','like','%'.$name.'%')
                ->paginate(10);
        }elseif($status !=null){
            $data['sitters']=DB::table('sitters')
                ->join('location','sitters.id','=','location.sitter')
                ->select('sitters.id','sitters.name','sitters.birthDay','sitters.status as status','sitters.created_at','location.address','location.district','location.city','sitters.images as img')
                ->orderBy('sitters.id','desc')
                ->where('sitters.status',$status)
                ->where('sitters.name','like','%'.$name.'%')
                ->paginate(10);
        }

        return view('parents.list_sitters',$data,
        [
            'gender'=>$gender,
            'province'=>$province_id
        ]);
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
        return response()->json(array('success'=>true));
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
    // delete feedback
    public function deleteFeedback($id){
        feedback_sitter::destroy($id);

        return response()->json(array('success'=>true));
    }

    // posts List
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

            // comments
        $comments['parents']=DB::table('comments')
        ->join('sitters','sitters.id','=','comments.sitter')
        ->select('comments.*','sitters.name as sitter_name')->get();

        $comments['sitters']=DB::table('comments')
        ->join('parents','parents.id','=','comments.parent')
        ->select('comments.*','parents.name as parent_name')->get();

        $data['comments']=array_merge($comments['parents']->toArray(),$comments['sitters']->toArray());
        return view('parents.posts.posts_list',$data);
    }
    // comment of post parent
    public function postComment($id, Request $request){
        $comment=new Comment();
        $comment->posts=$id;
        $comment->parent=Auth::guard('parents')->user()->id;
        $comment->content=$request->content;
        $comment->save();

        // return response()->json(array(['success'=>true]));
        return back()->with('success','Bình luận đã được gửi');
    }
    //delete comment
    public function deleteComment($id){
        Comment::destroy($id);
        return back()->with('success','Đã xóa bình luận');
    }

    // post add
    public function postAddPost(Request $request){
        $this->validate($request,[
            'title'=>'min:5',
            'image'=>'image'
        ],[
            'title.min'=>'Tiêu đề tối thiểu 5 kí tự',
            'image.image'=>'Hình ảnh không đúng định dạng'
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->parent=Auth::guard('parents')->user()->id;
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
    //delete post
    public function getDeletePost($id){
        $id_parent=Auth::guard('parents')->user()->id;
        $post=Post::findOrFail($id);
        if($id_parent == $post->parent){
            Post::destroy($id);
            return back()->with('success','Bạn đã xóa bài viết thành công');
        }else{
            return abort(404);
        }
    }
    // sitter post
    public function sitterPost($id){
        $data['sitter']=DB::table('sitters')->where('id',$id)->get();
        $data['posts']=DB::table('posts')
            ->where('sitter',$id)
            ->get();
        return view('parents.posts.sitter_posts',$data);
    }

    // post parent
    public function getPostsParent(){
        $id_parent=Auth::guard('parents')->user()->id;
        $data['posts']=DB::table('posts')
        ->where('parent',$id_parent)
        ->orderBy('id','desc')->paginate(15);

        return view('parents.profile.posts',$data);
    }
    // show profile parent difficult
    public function getProfileParentId($id){
        $data['parent']=Parents::find($id);
        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',$id)
        ->select('feedback_parents.*','sitters.name','sitters.images')
        ->get();
        return view('parents.parent_profile',$data);
    }
    // show contract
    public function getContract(){
        $data['contracts']=DB::table('contracts')
        ->where('parent',Auth::guard('parents')->user()->id)
        ->join('sitters','contracts.sitter','=','sitters.id')
        ->select('contracts.*','sitters.name as sitter_name','sitters.images as sitter_img')
        ->orderByDesc('created_at')
        ->get();
        return view('parents.profile.contract',$data);
    }
    // detail contract
    public function detailContract($id){
        $contract=DB::table('contracts')
            ->where('contracts.id',(int)$id)
            ->join('sitters','sitters.id','=','contracts.sitter')
            ->select('contracts.*','sitters.name','sitters.images')
            ->first();

        dd($contract);
    }
    // export pdf contract
    public function exportContract($id){
        $data['contract']=Contract::find($id);
        $pdf=PDF::loadView('pdf.contract_parent',$data);
        return $pdf->download('contract.pdf');
    }

    // send contract to sitter
    public function sendRequestContractSitter($id){
        $contract=new Contract();
        $contract->parent=Auth::guard('parents')->user()->id;
        $contract->sitter=$id;
        $sitter=Sitters::findOrFail($id);
        $description=" Bên A: ".Auth::guard('parents')->user()->name."(có ID người dùng: ".Auth::guard('parents')->user()->id."</b>) là ngưởi gửi yêu cầu làm việc với bên B
        Bên B: ".$sitter->name."( có ID người dùng: <b>".$sitter->id.") sẽ xem yêu cầu kí kết hợp đồng
        Giá: ".number_format($sitter->money)." VND/Buổi (Có thể tự thỏa thuận)
        Chúng tôi chỉ cung cấp nền tảng, mọi vấn đề xảy ra chúng tôi sẽ không chịu trách nhiệm.";
        $contract->money=$sitter->money;
        $contract->description=$description;
        $contract->status=0;
        $contract->check=1;
        $check_is_sent=DB::table('contracts')
                ->where([
                    'sitter'=>$id,
                    'sitter'=>Auth::guard('parents')->user()->id,
                    'status'=>0
                ])->get();
        if(count($check_is_sent)!=0){
            return back()->with('errors','Gửi yêu cầu không thành công! Có thể do bạn đã thực hiện yêu cầu hoặc có 1 vấn đề nào đó');
        }
        $contract->save();
        // content data mail send sitter
        $data['parent_name']=Auth::guard('parents')->user()->name;
        $data['parent_id']=Auth::guard('parents')->user()->id;
        $data['money']=$sitter->money;
        $data['description']=$description;

        $email=$sitter->email;
        // send mail confirm to sitter
        Mail::send('sendMailSitter',$data, function ($message) use ($email) {
            $message->from('khoab1606808@gmail.com', 'Khoa Bui');

            $message->to($email);

            $message->subject('Xác nhận yêu cầu kí kết làm việc');
        });
        return back()->with('success','Đã gửi yêu cầu thành công');
    }
    // accept contract
    public function acceptContract($id){
        $contract=Contract::find($id);
        $contract->status=1;
        $contract->is_work=1;
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
        $data['sitters']=Sitters::all();
        return view('parents.chat',$data);
    }

    // show chat by ID sitter
    public function showChatSitter($id){
        $data['sitters']=Sitters::all();
        $data['sitter']=Sitters::find($id);
        $data['chats']=Message::where('parent',Auth::guard('parents')->user()->id)
        ->where('sitter',$id)->get();
        return view('parents.chatId',$data);
    }

    // sent notification sitter
    public function sentNoti($id){
        $my_id=Auth::guard('parents')->user()->id;

        $sitter=Sitters::find($id);
        $sitter_name=$sitter->name;
        $parent=Parents::find($my_id)->name;
        OneSignal::sendNotificationToAll(
            "Bạn nhận được tin nhắn từ Phụ huynh ".$parent." ",
            $url = "/sitter/chat/".$my_id."",
            $data = null,
            $buttons = null,
            $schedule = null
        );
        return response()->json(array('success'=>true));
    }
    //post chat
    public function postShowChatSitter(Request $request,$id){

    }
    //delete account
    public function deleteAccount(){
        $id=Auth::guard('parents')->user()->id;
        Parents::destroy($id);
        return redirect('parent/login')->with('success','Bạn đã xóa tài khoản của mình');
    }
    ////////////////////// password reset //////////////////////////////
    public function sendMailToReset(Request $request){
        $email_reset=$request->email_reset;
        $parent=Parents::where('email',$email_reset)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $parent->email,
        ], [
            'token' => Str::random(60),
        ]);

        $token=PasswordReset::where('email',$email_reset)->select('token')->first('token');
        $data['url']=url('parent/login/reset_password/'.$token->token);
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
        $parent = Parents::where('email', $passwordReset->email)->firstOrFail();
        $parent->password=bcrypt('123456');
        $parent->save();
        $passwordReset->delete();

        return redirect('parent/login')->with('pass_reset','Mật khẩu mới của bạn là \n 123456');
    }

}
