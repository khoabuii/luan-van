@extends('layouts.parentLayout.parent_chat')
@section('title','Chat')
@section('content')
<div class="container">
<h3 class=" text-center">Trò chuyện</h3>
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

            @foreach($sitters as $sitter)
                <div class="chat_list">
                <div class="chat_people">
                <div class="chat_img"> <img src="{{asset('uploads/sitters_profile')}}/{{$sitter->images}}" alt="sunil"> </div>
                <a href="{{asset('parent/chat')}}/{{$sitter->id}}" onclick="return chat_{{$sitter->id}}();">
                    <div class="chat_ib">
                        <h5>{{$sitter->name}} <span class="chat_date">-</span></h5>
                        {{-- <p>------------------</p> --}}
                    </div>
                </a>
                </div>
            </div>
            <script>
                function chat_{{$sitter->id}}(){
                    location.reload();
                }
            </script>
            @endforeach
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
        // console.log(sitter_id);
        axios.post('/api/save-token',{
            fcm_token, sitter_id
            }).then(res=>{
            console.log(res);
        });
    }
    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken().then((currentToken) => {
    if (currentToken) {
        sendTokenToServer(currentToken);
        // updateUIForPushEnabled(currentToken);
    } else {
        // Show permission request.
        console.log('No Instance ID token available. Request permission to generate one.');
        // Show permission UI.
        // updateUIForPushPermissionRequired();
        // setTokenSentToServer(false);
    }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // showToken('Error retrieving Instance ID token. ', err);
        // setTokenSentToServer(false);
    });
</script> --}}
@endsection
