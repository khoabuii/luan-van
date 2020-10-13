<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>Sitter| @yield('title')</title>
	<meta name="description" content="PetSitter - Responsive HTML5 Template - 1.0">
	<meta name="author">
    <meta charset="utf-8">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">


	<!-- CSS
	================================================== -->
	<!-- Base + Vendors CSS -->
	{{-- <link rel="stylesheet" href="{{asset('homepage/css/bootstrap.min.css')}}"> --}}
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	<link rel="stylesheet" href="{{asset('homepage/css/fonts/entypo/css/entypo.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/vendor/owl-carousel/owl.carousel.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/owl-carousel/owl.theme.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/magnific-popup/magnific-popup.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/flexslider/flexslider.css')}}" media="screen">

    <link rel="stylesheet" href="{{asset('homepage/vendor/job-manager/frontend.css')}}" media="screen">

    {{-- star --}}
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

	<!-- Theme CSS-->
	<link rel="stylesheet" href="{{asset('homepage/css/theme.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/theme-elements.css')}}">
    <link rel="stylesheet" href="{{asset('homepage/css/animate.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"

  <!-- Head Libs -->
	<script src="{{asset('homepage/vendor/modernizr.js')}}"></script>

	<link rel="shortcut icon" href="{{asset('homepage/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{asset('homepage/images/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('homepage/images/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('homepage/images/apple-touch-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('homepage/images/apple-touch-icon-144x144.png')}}">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
     integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Map -->

    <!-- firebase -->
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyCWL1JioFFgVfp7mP05MkSSSoigV6_cVvg",
            authDomain: "luan-van-e8dfd.firebaseapp.com",
            databaseURL: "https://luan-van-e8dfd.firebaseio.com",
            projectId: "luan-van-e8dfd",
            storageBucket: "luan-van-e8dfd.appspot.com",
            messagingSenderId: "115901231588",
            appId: "1:115901231588:web:00c34bc2544ce729ab17f1",
            measurementId: "G-XD5CCQ9TKC"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        // firebase.analytics();
    </script>
    <!-- axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        .container{max-width:1170px; margin:auto;}
        img{ max-width:100%;}
        .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 40%; border-right:1px solid #c4c4c4;
        }
        .inbox_msg {
        border: 1px solid #c4c4c4;
        clear: both;
        overflow: hidden;
        }
        .top_spac{ margin: 20px 0 0;}


        .recent_heading {float: left; width:40%;}
        .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%; padding:
        }
        .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

        .recent_heading h4 {
        color: #05728f;
        font-size: 21px;
        margin: auto;
        }
        .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
        .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
        }
        .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

        .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
        .chat_ib h5 span{ font-size:13px; float:right;}
        .chat_ib p{ font-size:14px; color:#989898; margin:auto}
        .chat_img {
        float: left;
        width: 11%;
        }
        .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
        }

        .chat_people{ overflow:hidden; clear:both;}
        .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
        }
        .inbox_chat { height: 550px; overflow-y: scroll;}

        .active_chat{ background:#c9d7e0;}

        .incoming_msg_img {
        display: inline-block;
        width: 6%;
        }
        .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
        }
        .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
        }
        .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
        }
        .received_withd_msg { width: 57%;}
        .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 60%;
        }

        .sent_msg p {
        background: #05728f none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 14px;
        margin: 0; color:#fff;
        padding: 5px 10px 5px 12px;
        width:100%;
        }
        .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
        .sent_msg {
        float: right;
        width: 46%;
        }
        .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
        }

        .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
        .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
        }
        .messaging { padding: 0 0 50px 0;}
        .msg_history {
        height: 516px;
        overflow-y: auto;
        }
    </style>
</head>
<body class="boxed">

	<div class="site-wrapper site-wrapper__boxed">

		<!-- Header -->
		@include('layouts.sittersLayout.sitter_header')
		<!-- Header / End -->

		<!-- Main -->
		<div class="main" role="main">
			<!-- Slider -->
			        {{-- deleted --}}
			<!-- Slider / End -->

			<!-- Page Content -->
			@yield('content')
			<!-- Page Content / End -->

			<!-- Footer -->
			{{-- @include('layouts.sittersLayout.sitter_footer') --}}
			<!-- Footer / End -->
		</div>
		<!-- Main / End -->
	</div>
	<!-- Javascript Files
	================================================== -->
	{{-- <script src="{{asset('homepage/vendor/jquery-1.11.0.min.js')}}"></script> --}}
	<script src="{{asset('homepage/vendor/jquery-migrate-1.2.1.min.js')}}"></script>
	{{-- <script src="{{asset('homepage/vendor/bootstrap.js')}}"></script> --}}
	<script src="{{asset('homepage/vendor/jquery.flexnav.min.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery.hoverIntent.minified.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery.flickrfeed.js')}}"></script>
	<script src="{{asset('homepage/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
	<script src="{{asset('homepage/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery.fitvids.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery.appear.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('homepage/vendor/flexslider/jquery.flexslider-min.js')}}"></script>

	<!-- Newsletter Form -->
	<script src="{{asset('homepage/vendor/jquery.validate.js')}}"></script>
	<script src="{{asset('homepage/js/newsletter.js')}}"></script>

    <script src="{{asset('homepage/js/custom.js')}}"></script>


	<script>
		jQuery(function($){
			$('body').addClass('loading');
		});

		$(window).load(function(){
			$('.flexslider').flexslider({
				animation: "fade",
				controlNav: true,
				directionNav: true,
				start: function(slider){
					$('body').removeClass('loading');
				}
			});
		});
    </script>
    <script>
        function fadeoutfunction(){
            setTimeout(function(){
            $('[id$=messages]').fadeOut();
            },5000);
        }
        $("document").ready(function(){
            setTimeout(function(){
                $("p.alert").remove();
            }, 7000 ); // 7 secs
        });
    </script>
    @yield('chat')
</body>
</html>
