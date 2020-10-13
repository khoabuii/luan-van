<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>Easy-BabySitter | @yield('title')</title>
	<meta name="description" content="PetSitter - Responsive HTML5 Template - 1.0">
	<meta name="author">
    <meta charset="utf-8">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">


	<!-- CSS
	================================================== -->
	<!-- Base + Vendors CSS -->
	<link rel="stylesheet" href="{{asset('homepage/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/fonts/font-awesome/css/font-awesome.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/fonts/entypo/css/entypo.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/vendor/owl-carousel/owl.carousel.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/owl-carousel/owl.theme.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/magnific-popup/magnific-popup.css')}}" media="screen">
	<link rel="stylesheet" href="{{asset('homepage/vendor/flexslider/flexslider.css')}}" media="screen">

    {{-- star --}}
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

	<!-- Theme CSS-->
	<link rel="stylesheet" href="{{asset('homepage/css/theme.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/theme-elements.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('homepage/vendor/job-manager/frontend.css')}}" media="screen">
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
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
     integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
      crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>

    <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <!--firebase -->
            <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-analytics.js"></script>

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
        firebase.analytics();
        </script>
    </head>
<body class="boxed">

	<div class="site-wrapper site-wrapper__boxed">

		<!-- Header -->
		@include('layouts.parentLayout.parent_header')
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
			@include('layouts.parentLayout.parent_footer')
			<!-- Footer / End -->
		</div>
		<!-- Main / End -->
	</div>
	<!-- Javascript Files
	================================================== -->
	<script src="{{asset('homepage/vendor/jquery-1.11.0.min.js')}}"></script>
	<script src="{{asset('homepage/vendor/jquery-migrate-1.2.1.min.js')}}"></script>
	<script src="{{asset('homepage/vendor/bootstrap.js')}}"></script>
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

     	<!-- Google Map -->
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="vendor/jquery.gmap3.min.js"></script>

	<!-- Google Map Init-->
	<script type="text/javascript">
		jQuery(function($){
			$('#map_canvas').gmap3({
				marker:{
					address: '9.9937036,105.7755366,11.25z'
				},
					map:{
					options:{
					zoom: 17,
					scrollwheel: false,
					streetViewControl : true
					}
				}
		    });
		});
    </script>

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
</body>
</html>
