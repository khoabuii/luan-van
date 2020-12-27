<?php
// Get the current URL without the query string...
 $url = url()->current();
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin/dashboard')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i><span>Trang tổng quan</span></a> </li>
      <li class="submenu @if(Request::is('admin/sitters')) active
                        @elseif(Request::is('admin/sitters/*')) active
                        @endif">
        <a href="#"><i class="icon icon-th-list"></i> <span>Bảo mẫu</span> <span class="label label-important"></span></a>
        <ul @if(Request::is('admin/sitters')) style="display:block;"
            @elseif(Request::is('admin/sitters/*')) style="display:block;"
            @endif
        >
        <li >
          <a href="{{url ('/admin/sitters')}}">Xem danh sách người bảo mẫu</a></li>
          <li>
            <a href="{{url ('/admin/sitters/skill')}}">Quản lý danh mục kỷ năng</a></li>
        </ul>
      </li>

      <li class="submenu @if(Request::is('admin/parents')) active
                        @elseif(Request::is('admin/parents/*')) active
                        @endif">
        <a href="#"><i class="icon icon-th-list"></i> <span>Phụ huynh</span> <span class="label label-important"></span></a>
        <ul @if(Request::is('admin/parents')) style="display:block;"
                @elseif(Request::is('admin/parents/*')) style="display:block;"
                @endif>
        <li >
          <a href="{{url ('/admin/parents')}}">Xem danh sách người phụ huynh</a></li>
          <li>
            <a href="{{url ('/admin/parents/add')}}">----------</a></li>
        </ul>
      </li>

      <li class="submenu <?php if(preg_match("/contracts/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Quản lý hợp đồng</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/contracts/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/contracts')}}">Xem danh sách hợp đồng</a></li>
          <li>
            <a href="{{url ('/admin/contract/add')}}">---------</a></li>
        </ul>
      </li>

      <li class="submenu <?php if(preg_match("/posts/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Quản lý bài viết</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/posts/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/posts')}}">Xem danh sách Bài viết</a></li>
          <li>
            <a href="{{url ('/admin/parents/add')}}">---------</a></li>
        </ul>
      </li>

      <li class="submenu <?php if(preg_match("/message/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Gửi thông điệp</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/message/i", $url)){ ?> style="display:block;" <?php } ?>>
            <li>
                <a href="{{url ('/admin/message')}}">Gửi Email cho tất cả người dùng</a>
            </li>

            <li>
                <a href="{{url ('/admin/message/sitters')}}">Gửi cho nhóm người bảo mẫu</a>
            </li>

            <li>
                <a href="{{url ('/admin/message/parents')}}">Gửi cho nhóm người Phụ huynh</a>
            </li>
        </ul>
      </li>

    </ul>
  </div>
  <!--sidebar-menu-->
