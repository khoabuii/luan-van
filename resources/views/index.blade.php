<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>Easy-BabySitter | Welcome</title>
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

	<!-- Theme CSS-->
	<link rel="stylesheet" href="{{asset('homepage/css/theme.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/theme-elements.css')}}">
	<link rel="stylesheet" href="{{asset('homepage/css/animate.min.css')}}">

  <!-- Head Libs -->
	<script src="{{asset('homepage/vendor/modernizr.js')}}"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="vendor/respond.min.js"></script>
	<![endif]-->

	<!--[if IE]>
		<link rel="stylesheet" href="css/ie.css">
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="{{asset('homepage/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{asset('homepage/images/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('homepage/images/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('homepage/images/apple-touch-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('homepage/images/apple-touch-icon-144x144.png')}}">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
	 integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="boxed">

	<div class="site-wrapper site-wrapper__boxed">

		<!-- Header -->
		<header class="header header-menu-fullw">

			<!-- Header Top Bar -->
			<div class="header-top">
				<div class="container">
					<div class="header-top-right">
						<button class="btn btn-sm btn-default menu-link menu-link__tertiary">
							<i class="fa fa-user"></i>
						</button>
						<div class="menu-container">
							<ul class="header-top-nav header-top-nav__tertiary">
								{{-- <li><a href="page-login.html"><i class="fa-pencil-square-o fa"></i> Đăng ký</a></li>
								<li><a href="page-login.html"><i class="fa-lock fa"></i> Đăng nhập</a></li> --}}
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Header Top Bar / End -->

			<div class="header-main">
				<div class="container">

					<!-- Logo -->
					<div class="logo">
						<a href="{{asset('/')}}"><img src="{{asset('homepage/images/logo.png')}}" alt="Babysitter"></a>
						<!-- <h1><a href="index.html"><strong>Baby</strong>sitter</a></h1> -->
						<p class="tagline hidden-xs hidden-sm">Best care for baby!</p>
					</div>
					<!-- Logo / End -->

					<button type="button" class="navbar-toggle">
						<i class="fa fa-bars"></i>
					</button>

		      <!-- Banner -->
		      <div class="head-info">
		      	<ul class="head-info-list">
		      		<li><span>Gọi cho chúng tôi:</span> +84 947018812</li>
		      	</ul>
		      	<ul class="social-links social-links__rounded social-links__colored">
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
						</ul>
		      </div>
		      <!-- Banner / End -->
				</div>
			</div>

			<!-- Navigation -->
			{{-- deleted --}}
			<!-- Navigation / End -->

		</header>
		<!-- Header / End -->

		<!-- Main -->
		<div class="main" role="main">
			<!-- Slider -->
			<section class="slider-holder">
				<div class="container">
					<div class="flexslider carousel">
						<ul class="slides">
							<li>
								<img src="{{asset('homepage/images/samples/slide1.jpg')}}" alt="" />
								<div class="flexslider-desc">
									<h1>Bạn có cần người trông con của bạn?</h1>
									<a href="#" class="link"><i class="fa fa-angle-double-right"></i></a>
								</div>
							</li>
							<li>
								<img src="{{asset('homepage/images/samples/slide2.jpg')}}" alt="" />
								<div class="flexslider-desc">
									<h1>Bạn có muốn tìm thu nhập part time?</h1>
									<a href="#" class="link"><i class="fa fa-angle-double-right"></i></a>
								</div>
							</li>
							<li>
								<img src="{{asset('homepage/images/samples/slide3.jpg')}}" alt="" />
								<div class="flexslider-desc">
									<h1>Chăm sóc tốt nhất cho những đứa trẻ</h1>
									<a href="#" class="link"><i class="fa fa-angle-double-right"></i></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- Slider / End -->

			<!-- Page Content -->
			<section class="page-content">
				<div class="container">

					<div class="row">
						<div class="col-md-4">
							<!-- Icon Box -->
							<div class="icon-box boxed circled icon-box-color__primary">
								<div class="icon-box-body">
									<h2>Kết nối không giới hạn</h2>
									Chúng tôi cung cấp giải pháp giúp mọi người dễ dàng liên hệ với nhau
								</div>
							</div>
							<!-- Icon Box / End -->
						</div>
						<div class="col-md-4">
							<!-- Icon Box -->
							<div class="icon-box boxed circled icon-box-color__secondary">
								<div class="icon-box-body">
									<h2>Kết nối thông minh</h2>
									Chúng tôi sử dụng những công nghệ hiện đại nhất để giải quyết những vấn đề cho khách hàng
								</div>
							</div>
							<!-- Icon Box / End -->
						</div>
						<div class="col-md-4">
							<!-- Icon Box -->
							<div class="icon-box boxed circled icon-box-color__tertiary">
								<div class="icon-box-body">
										<h2>Bảo vệ thông tin khách hàng</h2>
										Chúng tôi đảm bảo thông tin của anh chị luôn được bảo mật.
								</div>
							</div>
							<!-- Icon Box / End -->
						</div>
					</div>


					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<!-- Call to Action -->
							<div class="call-to-action call-to-action__no-bg centered">
								<div class="cta-txt">
									<h1>Chào mừng bạn đã đến website của chúng tôi!</h1>
									<p>Chúng tôi hy vọng sẽ mang lại trãi nghiệm tốt nhất cho bạn. Hãy đăng ký tham gia vào hệ thống của chúng tôi nhé! </p>
								</div>
								<div class="col-md-6">
											<div class="cta-btn">
												<a href="{{asset('/parent')}}" class="btn btn-primary btn-lg">Tham gia với vai trò là Phụ huynh</a>
											</div>
										</div>
									<div class="col-md-6">
										<div class="cta-btn">
											<a href="{{asset('/sitter')}}" class="btn btn-tertiary btn-lg">Tham gia với vai trò là Babysitter</a>
										</div>
								</div>

							</div>
							<!-- Call to Action / End -->
						</div>
					</div>

					<div class="spacer-xl"></div>

					<div class="row">
						<div class="col-md-4">
							<h2>Về chúng tôi</h2>
							<p class="lead">Đây là luận văn về web học kì 2 năm học 2020-2021</p>
							<p>Hãy sử dụng website của chúng tôi,</p>
							<p>Website mang lại trãi nghiệm tốt nhất dành cho bạn giúp bạn kiếm được những thứ mà bạn cần</p>
							<a href="#" class="btn btn-primary">Đọc thêm</a>
						</div>
						<div class="col-md-4">
							<h2>Dịch vụ của chúng tôi</h2>
							<p>Chúng tôi luôn mang lại những trãi nghiệm tốt nhất dành cho khách hàng. </p>
							<div class="list">
								<ul>
									<li>Babbysitter</li>
									<li>Parents</li>

								</ul>
							</div>
							<a href="#" class="btn btn-primary">Xem tất cả dịch vụ</a>
						</div>
						<div class="col-md-4">
							<h2>Lời khuyên của chúng tôi</h2>
							<ul class="latest-posts-list">
								<li>
									<figure class="thumbnail"><a href="#"><img src="images/samples/post-img-1-sm.jpg" alt=""></a></figure>
									<span class="date">24/07/2020</span>
									<h5 class="title"><a href="#">Tìm babysitter như thế nào cho hiệu quả nhất</a></h5>
								</li>
								<li>
									<figure class="thumbnail"><a href="#"><img src="images/samples/post-img-2-sm.jpg" alt=""></a></figure>
									<span class="date">16/07/2020</span>
									<h5 class="title"><a href="#">Trẻ biến ăn thì giải quyết thế nào.</a></h5>
								</li>
								<li>
									<figure class="thumbnail"><a href="#"><img src="images/samples/post-img-3-sm.jpg" alt=""></a></figure>
									<span class="date">14/07/2020</span>
									<h5 class="title"><a href="#">Các tiêu chí chọn sửa cho bé</a></h5>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- Page Content / End -->

			<!-- Footer -->
			<footer class="footer" id="footer">
				<div class="footer-widgets">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<!-- Widget :: Custom Menu -->
								<div class="widget_nav_menu widget widget__footer">
									<h3 class="widget-title">Bạn có biết?</h3>
									<div class="widget-content">
										Các khách hàng luôn nhận sự hài lòng cho dịch vụ của chúng tôi. Chúng tôi luôn mang lại giải pháp tốt nhất cho quý phụ huynh và những bạn cần tìm công việc part time.
									</div>
								</div>
								<!-- /Widget :: Custom Menu -->
							</div>
							<div class="col-sm-6 col-md-3">
								<!-- Widget :: Tags Cloud -->
								<div class="widget_tag_cloud widget widget__footer">
									<h3 class="widget-title">Tag Cloud</h3>
									<div class="tagcloud">
										<a href="#" class="btn btn-secondary btn-sm">Babysitting</a>
										<a href="#" class="btn btn-secondary btn-sm">Babysitting Jobs</a>
										<a href="#" class="btn btn-secondary btn-sm">Nannies</a>
										<a href="#" class="btn btn-secondary btn-sm">Tutoring</a>
										<a href="#" class="btn btn-secondary btn-sm">Tutors</a>
										<a href="#" class="btn btn-secondary btn-sm">Child Care Jobs</a>
										<a href="#" class="btn btn-secondary btn-sm">Nanny Jobs</a>
										<a href="#" class="btn btn-secondary btn-sm">Child Care</a>
									</div>
								</div>
								<!-- /Widget :: Tags Cloud -->
							</div>

							<div class="clearfix visible-sm"></div>

							<div class="col-sm-6 col-md-3">
								<!-- Widget :: Latest Posts -->
								<div class="latest-posts-widget widget widget__footer">
									<h3 class="widget-title">Bài viết nổi bật</h3>
									<div class="widget-content">
										<ul class="latest-posts-list">
											<li>
												<h5 class="title"><a href="#">Tìm babysitter như thế nào cho hiệu quả nhất.</a></h5>
												<span class="date">July, 18 2020</span>
											</li>
											<li>
												<h5 class="title"><a href="#">Cách giữ trẻ luôn khỏe mạnh trong thời tiết lạnh.</a></h5>
												<span class="date">July, 21 2020</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Widget :: Latest Posts -->
							</div>
							<div class="col-sm-6 col-md-3">
								<!-- Widget :: Newsletter -->
								<div class="widget_newsletter widget widget__footer">
									<h3 class="widget-title">Đăng ký nhận tin tức </h3>
									<div class="widget-content">
										<p>Nhận những thông tin mới nhất, luôn luôn cập nhật từ email của các bạn </p>

										<form action="php/newsletter-form.php" method="POST" id="newsletter-form">
											<div class="alert alert-success hidden" id="newsletter-alert-success">
												<strong>Success!</strong> Thank you for subscribing.
											</div>
											<div class="alert alert-danger hidden" id="newsletter-alert-error">
												<strong>Error!</strong> Something went wrong.
											</div>
											<div class="input-group">
												<input type="email"
													value=""
													data-msg-required="Please enter email address."
													data-msg-email="Please enter a valid email address."
													class="form-control"
													placeholder="Enter your email here..."
													name="subscribe-email"
													id="subscribe-email">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success btn-block" data-loading-text="Loading...">Go!</button>
												</span>
											</div>
										</form>

									</div>
								</div>
								<!-- /Widget :: Newsletter -->
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-6">
								Copyright &copy; 2020 <a href="#">Babysitter</a> &nbsp;| &nbsp;All Rights Reserved
							</div>
							<div class="col-sm-6 col-md-6">
								Created by <a href="#">Khoa Bui</a>
							</div>
						</div>
					</div>
				</div>
			</footer>
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
</body>
</html>
