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
                        @if(Auth::check())
                            Xin chào, <span style="color: blue">{{Auth::user()->name}}</span>
                            <a href="{{asset('/sitter/logout')}}"> (Đăng xuất)</a>
                        @else
                            <li><a href="{{asset('/sitter/register')}}"><i class="fa-pencil-square-o fa"></i> Đăng ký</a></li>
                            <li><a href="{{asset('/sitter/login')}}"><i class="fa-lock fa"></i> Đăng nhập</a></li>
                        @endif
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
                <a href="{{asset('/sitter')}}"><img src="{{asset('homepage/images/logo.png')}}" alt="Babysitter"></a>
                <!-- <h1><a href="index.html"><strong>Baby</strong>sitter</a></h1> -->
                <p class="tagline hidden-xs hidden-sm">Trang dành cho Babysitter</p>
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
@if(Auth::user())
    <!-- Navigation menu -->
    <nav class="nav-main">
        <div class="container">
            <ul data-breakpoint="992" class="flexnav">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Sitters</a></li>
                <li><a href="#">Bài viết</a>
                    <ul>
                        <li><a href="features-shortcodes.html">Shortcodes</a></li>
                        <li><a href="features-pricing-tables.html">Pricing Tables</a></li>
                        <li><a href="features-typography.html">Typography</a></li>
                        <li><a href="features-columns.html">Columns</a></li>
                        <li><a href="features-icons.html">Icons</a></li>
                    </ul>
                </li>
                <li><a href="#">Tìm kiếm</a> </li>
                <li><a href="blog-right-sidebar.html">Trò chuyện</a></li>
                <li><a href="contacts.html">Hồ sơ ({{Auth::user()->name}})</a>
                    <ul>
                        <li><a href="{{asset('sitter/profile')}}">Xem hồ sơ</a></li>
                        <li><a href="{{asset('sitter/profile/posts')}}">Đăng bài tuyển dụng</a></li>
                        <li><a href="{{asset('sitter/profile/update')}}">Cập nhật tài khoản</a></li>
                    </ul>
                </li>
                <li><a href="#">Danh sách đã đánh dấu</a></li>
            </ul>
        </div>
    </nav>
    <!-- Navigation menu / End -->
@endif
</header>
