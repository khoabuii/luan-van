<?php
// Get the current URL without the query string...
 $url = url()->current();
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin/dashboard')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i><span>Trang tổng quan</span></a> </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Nhà cung cấp</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/vendor/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-vendor/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{url ('/admin/add-vendor')}}">Thêm nhà cung cấp</a></li>
          <li <?php if(preg_match("/view-vendors/i", $url)){ ?> class="active" <?php }
           ?>>
            <a href="{{url ('/admin/view-vendors')}}">Xem danh sách nhà cung cấp</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Danh mục</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/category/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{url ('/admin/add-category')}}">Thêm danh mục</a></li>
          <li <?php if(preg_match("/view-categories/i", $url)){ ?> class="active" <?php }
           ?>>
            <a href="{{url ('/admin/view-categories')}}">Xem danh sách danh mục</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Thương hiệu</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/brand/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-brand/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{url ('/admin/add-brand')}}">Thêm thương hiệu</a></li>
          <li <?php if(preg_match("/view-brands/i", $url)){ ?> class="active" <?php }
           ?>>
            <a href="{{url ('/admin/view-brands')}}">Xem danh sách thương hiệu</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Sản phẩm</span> <span class="label label-important"></span></a>
        <ul <?php if(preg_match("/product/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{url ('/admin/add-product')}}">Thêm sản phẩm</a></li>
          <li <?php if(preg_match("/view-products/i", $url)){ ?> class="active" <?php } ?>>
            <a href="{{url ('/admin/view-products')}}">Xem danh sách sản phẩm</a></li>
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
