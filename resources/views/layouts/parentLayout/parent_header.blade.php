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
                        @if(Auth::guard('parents')->check())
                            Xin chào, <span style="color: blue">{{Auth::guard('parents')->user()->name}}</span>
                        <a href="{{asset('/parent/logout')}}">(Đăng xuất)</a>
                        @else
                        <li><a href="{{asset('/parent/register')}}"><i class="fa-pencil-square-o fa"></i> Đăng ký</a></li>
                        <li><a href="{{asset('/parent/login')}}"><i class="fa-lock fa"></i> Đăng nhập</a></li>
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
                <a href="{{asset('/')}}"><img src="{{asset('homepage/images/logo.png')}}" alt="Babysitter"></a>
                <!-- <h1><a href="index.html"><strong>Baby</strong>sitter</a></h1> -->
                <p class="tagline hidden-xs hidden-sm">Trang dành cho Phụ huynh</p>
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
    @if(Auth::guard('parents')->check())
    <!-- Navigation menu -->
    <nav class="nav-main">
        <div class="container">
            <ul data-breakpoint="992" class="flexnav">
                <li
                    @if(Request::is('parent'))
                        class="active"
                     @endif
                >
                <a href="{{asset('/parent')}}">Home</a></li>
                <li
                    @if(Request::is('parent/list_sitters'))
                        class="active"
                    @endif
                ><a href="{{asset('/parent/list_sitters')}}">Sitters</a></li>

                <li
                    @if(Request::is('parent/posts'))
                        class="active"
                    @elseif(Request::is('parent/posts/*'))
                        class="active"
                    @endif
                ><a href="{{asset('/parent/posts')}}">Bài viết</a>
                    <ul>
                        <li><a href="{{asset('/parent/posts/add')}}">Đăng bài viết mới</a></li>
                        <li><a href="{{asset('/parent/posts')}}">Xem danh sách bài viết</a></li>
                        <li><a href="{{asset('/parent/profile/posts')}}">Bài viết của tôi</a></li>
                    </ul>
                </li>
                <li><a href="#">Tìm kiếm</a> </li>
                <li
                    @if(Request::is('parent/chat/*'))
                        class="active"
                    @elseif(Request::is('parent/chat'))
                        class="active"
                    @endif
                ><a href="{{asset('parent/chat')}}">Trò chuyện</a></li>
                <li
                    @if(Request::is('parent/profile'))
                        class="active"
                    @endif
                ><a href="{{asset('parent/profile/')}}">Hồ sơ</a>
                    <ul>
                        <li><a href="{{asset('parent/profile/')}}">Xem hồ sơ</a></li>
                        <li><a href="blog-left-sidebar.html">Đăng bài tuyển dụng</a></li>
                        <li><a href="{{asset('parent/profile/update_info')}}">Cập nhật tài khoản</a></li>
                    </ul>
                </li>
                <li @if(Request::is('parent/save_sitters'))
                        class="active"
                     @endif
                    >
                    <a href="{{asset('parent/save_sitters')}}">Danh sách đã đánh dấu</a></li>
                <li
                    @if(Request::is('parent/contract'))
                        class="active"
                    @endif
                ><a href="{{asset('parent/contract')}}"><i  class="fa fa-life-ring"></i> Hợp đồng</a></li>
            </ul>
        </div>
    </nav>
    <!-- Navigation menu / End -->
    @endif
</header>
