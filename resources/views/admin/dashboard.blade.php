@extends('layouts.adminLayout.admin_design')
@section('title','Dashboard')
@section('content')

<!--main-container-part-->
<div id="content" style="margin-top:-75px;">
    <!--breadcrumbs-->
      <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
      </div>
    <!--End-breadcrumbs-->
    <!--Action boxes-->
      <div class="container-fluid">
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb"> <a href="{{url ('/admin/dashboard')}}"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
          <li class="bg_lg span3"> <a href="{{url ('/admin/view-categories')}}"> <i class="icon icon-list"></i><span class="label label-important">11</span> Phụ huynh</a> </li>
            <li class="bg_ly"> <a href="{{url ('/admin/view-products')}}"> <i class="icon icon-list"></i><span class="label label-success">11</span> Bảo mẫu </a> </li>
            <li class="bg_lo"> <a href="{{url ('/admin/view-coupons')}}"> <i class="icon icon-list"></i><span class="label label-info">11</span> Bài viết</a> </li>
            <li class="bg_ls"> <a href="{{url ('/admin/view-orders')}}"> <i class="icon-fullscreen"></i><span class="label label-warning">222</span> Hợp đồng</a> </li>

          </ul>
        </div>
    <!--End-Action boxes-->

    <!--Chart-box-->
        <div class="row-fluid">
          <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
              <h5>Thống kê</h5>
            </div>
            <div class="widget-content" >
              <div class="row-fluid">
                <div class="span12">
                    <ul class="site-stats">
                      <li class="bg_lh"><i class="icon-user"></i> <strong>{{count($sitters)+count($parents)}}</strong> <h4>Tổng số người dùng</h4></li>
                       <li class="bg_lh"><i class="icon-user"></i> <strong>{{count($sitters)}}</strong><h4>Tổng số người bảo mẫu</h4></li>
                       <li class="bg_lh"><i class="icon-plus"></i> <strong>{{count($parents)}}</strong><h4>Tổng số người Phụ huynh</h4></li>
                        <li class="bg_lh"><i class="icon-globe"></i> <strong>{{count($contracts)}}</strong><h4>Tổng Hợp đồng</h4></li>
                      </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    <!--End-Chart-box-->
        <hr/>

      </div>
    </div>

    <!--end-main-container-part-->
@endsection
