<?php

namespace App\Http\Controllers;

use App\Contract;
use App\feedback_sitter;
use App\img_sitter;
use App\Location;
use App\Message;
use App\Parents;
use App\Post;
use App\Province;
use App\save_sitters;
use App\Sitters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use Maatwebsite\Excel\Concerns\ToArray;
class ParentsController extends Controller
{
    //
    public function getIndex(){
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

        $data['check_is_contract']=DB::table('contracts')
            ->where([
                'sitter'=>$id,
                'parent'=>Auth::guard('parents')->user()->id,
                'status'=>0
            ])->get();
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
        $data['posts']=DB::table('posts')
        ->join('parents','posts.parent','=','parents.id')
        ->select('posts.*','parents.name','parents.avatar')
        ->orderBy('posts.id','desc')
        ->paginate(15);
        return view('parents.posts.posts_list',$data);
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
    // post parent
    public function getPostsParent(){
        $id_parent=Auth::guard('parents')->user()->id;
        $data['posts']=DB::table('posts')
        ->where('parent',$id_parent)
        ->orderBy('id','desc')->paginate(15);

        return view('parents.profile.posts',$data);
    }
    public function getProfileParentId($id){
        $data['parent']=Parents::find($id);
        $data['feedback']=DB::table('feedback_parents')
        ->join('sitters','feedback_parents.sitter','=','sitters.id')
        ->where('parent',$id)
        ->select('feedback_parents.*','sitters.name','sitters.images')
        ->get();
        return view('parents.parent_profile',$data);
    }
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
        // send mail confirm to sitter
        Mail::send('sendMailSitter',$data, function ($message) {
            $message->from('khoab1606808@gmail.com', 'Khoa Bui');

            $message->to('khoabuii98@yahoo.com');

            $message->subject('Xác nhận yêu cầu kí kết làm việc');
        });
        return redirect('/parent')->with('success','Đã gửi yêu cầu thành công');
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
    //post chat
    public function postShowChatSitter(Request $request,$id){
        $input=$request->all();
        $message=$input['message'];
        $chat =new Message([
            'sitter'=>$id,
            'parent'=>Auth::guard('parents')->user()->id,
            'content'=>$message,
            'check'=>1
        ]);
        $this->broadcastMessage($id,Auth::guard('parents')->user()->id,$message,1);
        $chat->save();
        return redirect()->back();
    }
    public function broadcastMessage($sitter, $parent,$content,$check){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Bạn có tin nhắn mới');
        $notificationBuilder->setBody($content)
                    ->setSound('default')
                    ->setClickAction('https://khoabui.dev/parent/'.$sitter);

        $dataBuilder=new PayloadDataBuilder();
        $dataBuilder->addData([
            'sitter'=>$sitter,
            'parent'=>$parent,
            'content'=>$content,
            'check'=>$check
        ]);
        $option=$optionBuilder->build();
        $notification=$notificationBuilder->build();
        $data=$dataBuilder->build();
        $tokens=Parents::all()->pluck('fcm_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        return $downstreamResponse->numberSuccess();
    }
    //delete account
    public function deleteAccount(){
        $id=Auth::guard('parents')->user()->id;
        Parents::destroy($id);
        return redirect('parent/login')->with('success','Bạn đã xóa tài khoản của mình');
    }
}
