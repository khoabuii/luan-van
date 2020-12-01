@extends('layouts.sittersLayout.sitter_chat')
@section('title','Chat')
@section('content')
<div class="container">
<h3 class=" text-center">Trò chuyện với {{$parent->name}}</h3>
<div class="messaging">
        <div class="inbox_msg">
        <div class="inbox_people">
            <div class="headind_srch">
            <div class="recent_heading">
                <h4>Recent</h4>
            </div>
            <div class="srch_bar">
                <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
            </div>
            <div class="inbox_chat">
            <?php
                $id_parent=$parent->id;
            ?>
            @foreach($parents as $parent)
            @if($parent->id==$id_parent)
            <div class="chat_list active_chat">
            @else
            <div class="chat_list">
            @endif
                <div class="chat_people">
                <div class="chat_img"> <img src="{{asset('uploads/parents_profile')}}/{{$parent->avatar}}" alt="sunil"> </div>
                <a href="{{asset('sitter/chat')}}/{{$parent->id}}"><div class="chat_ib">
                    <h5>{{$parent->name}} <span class="chat_date">Dec 25</span></h5>
                    <p>-----------</p>
                </div></a>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        <div class="mesgs">
            <div class="msg_history" id="messages">
                <script>
                    var sitter_id='{{Auth::user()->id}}';
                    var parent_id='{{$id_parent}}';
                    var title=sitter_id +'-'+ parent_id;
                    var today=new Date();
                    var time=today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' | '+today.getHours()+':'+today.getMinutes();
                    function sendMessage() {
                        $.ajax({
                        type:'GET',
                        url:"{{asset('sitter/chat/sentNoti/1')}}",
                        success: function(data){

                        }
                    });
                        // get message
                        var message = document.getElementById("message").value;
                        document.getElementById("message").value="";
                        // save in database
                        firebase.database().ref(title).push().set({
                            "sitter":sitter_id,
                            'parent':parent_id,
                            'check':0,
                            "message": message,
                            "time":time
                        });

                        return false;
                    }
                </script>
                <script>
                    firebase.database().ref(title).on("child_added", function (snapshot) {
                        var html=' ';
                        var message=snapshot.val().message;
                        var time=snapshot.val().time;
                        if(snapshot.val().check==1){
                            html +='<div class="incoming_msg" ';
                            // html +='<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil" width="10%"> </div>';
                            html += '<div class="received_msg">';
                            html += '<div class="received_withd_msg">';
                            html +='<p>';
                            html += message;
                            html += '</p>';
                            html +=  '<span class="time_date">';
                            html += time;
                            html += '</span></div>';
                            html +=  '  </div>';
                            html +='</div>';
                        }else{
                            html +='<div class="outgoing_msg">';
                            html +='<div class="sent_msg">';
                            html +='<p id="message-'+snapshot.key+'">';
                            html +=message;
                            html +=' </p>';
                            html +=  '<span class="time_date">';
                            html += time;
                            html += '   <small><button class="" data-id="'+snapshot.key+'" onclick="deleteMessage(this);">X</button></small> </span></div>';
                            html +='</div>';
                        }
                        document.getElementById("messages").innerHTML += html;

                    });
                    function deleteMessage(self) {
                        // get message ID
                        var messageId = self.getAttribute("data-id");
                        // delete message
                        firebase.database().ref(title).child(messageId).remove();
                    }
                    // attach listener for delete message
                        firebase.database().ref(title).on("child_removed", function (snapshot) {
                        // remove message node
                        document.getElementById("message-"+snapshot.key).innerHTML = "Tin nhắn này đã được xóa khỏi hệ thống";
                    });
                </script>
            </div>
            <div class="type_msg">
                <form onsubmit="return sendMessage();">
                    {{csrf_field()}}
                    <div class="input_msg_write">
                        <input id="message" type="text" class="write_msg" name="message" placeholder="Type a message" autocomplete="off" />
                        <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('chat')

{{-- <script>
    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
    // Add the public key generated from the console here.
    messaging.usePublicVapidKey("BDHljmQiTJb0gjkkkKPwCFiLPyqV9N3O3rlY_By9Oa0S7f4bLIMWMsg9Z-CepjriJgFka8L_jGm_PZbCW5c4pcI");
    function sendTokenToServer(fcm_token){
        const sitter_id='{{Auth::user()->id}}';
        const parent_id='{{$id_parent}}';
        axios.post('/api/save-token',{
            fcm_token, sitter_id,parent_id
            }).then(res=>{
            console.log(res);
        });
    }
    function retrieveToken(){
        messaging.getToken().then((currentToken) => {
        if (currentToken) {
            sendTokenToServer(currentToken);
            // updateUIForPushEnabled(currentToken);
        } else {
            // Show permission request.
            console.log('No Instance ID token available. Request permission to generate one.');
        }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
           });
        // });
            // Get Instance ID token. Initially this makes a network call, once retrieved
            // subsequent calls to getToken will return from cache.

    retrieveToken();
    messaging.onTokenRefresh(()=>{
        retrieveToken();
    });
    messaging.onMessage((payload)=>{
        console.log('Message received.');
        console.log(payload);
        location.reload();
    });
    }
</script> --}}
@endsection
