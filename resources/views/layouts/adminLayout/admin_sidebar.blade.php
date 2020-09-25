<?php
// Get the current URL without the query string...
 $url = url()->current();
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin/dashboard')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i><span>Trang tổng quan</span></a> </li>
      <li class="submenu <?php if(preg_match("/sitters/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Bảo mẫu</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/sitters/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/sitters')}}">Xem danh sách người bảo mẫu</a></li>
          <li>
            <a href="{{url ('/admin/sitters/add')}}">Thêm người bảo mẫu</a></li>
        </ul>
      </li>

      <li class="submenu <?php if(preg_match("/parents/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Phụ huynh</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/parents/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/parents')}}">Xem danh sách người bảo mẫu</a></li>
          <li>
            <a href="{{url ('/admin/parents/add')}}">Thêm người bảo mẫu</a></li>
        </ul>
      </li>

      <li class="submenu <?php if(preg_match("/parents/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Quản lý hợp đồng</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/parents/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/parents')}}">Xem danh sách người bảo mẫu</a></li>
          <li>
            <a href="{{url ('/admin/parents/add')}}">Thêm người bảo mẫu</a></li>
        </ul>
      </li>
      <li class="submenu <?php if(preg_match("/parents/i", $url)){ ?> active <?php } ?>">
        <a href="#"><i class="icon icon-th-list"></i> <span>Quản lý bài viết</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/parents/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li >
          <a href="{{url ('/admin/parents')}}">Xem danh sách người bảo mẫu</a></li>
          <li>
            <a href="{{url ('/admin/parents/add')}}">Thêm người bảo mẫu</a></li>
        </ul>
      </li>
      
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Mã giảm giá</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/coupon/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-coupon/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{url ('/admin/add-coupon')}}">Thêm mã giảm giá</a></li>
          <li <?php if(preg_match("/view-coupons/i", $url)){ ?> class="active" <?php } ?>>
            <a href="{{url ('/admin/view-coupons')}}">Xem danh sách mã giảm giá</a></li>
        </ul>
      </li>

      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Đơn hàng</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/orders/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/view-orders/i", $url)){ ?> class="active" <?php } ?>>
            <a href="{{url ('/admin/view-orders')}}">Xem danh sách đơn hàng </a></li>
        </ul>
      </li>

      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Thành viên</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/member/i", $url)){ ?> style="display:block;" <?php } ?>>
          <li <?php if(preg_match("/view-members/i", $url)){ ?> class="active" <?php } ?>>
            <a href="{{url ('/admin/view-members')}}">Xem danh sách thành viên</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!--sidebar-menu-->
