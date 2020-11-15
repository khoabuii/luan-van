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
          <li class="bg_lg span3"> <a href="{{url ('/admin/view-categories')}}"> <i class="icon icon-list"></i><span class="label label-important">{{count($parents)}}</span> Phụ huynh</a> </li>
            <li class="bg_ly"> <a href="{{url ('/admin/view-products')}}"> <i class="icon icon-list"></i><span class="label label-success">{{count($sitters)}}</span> Bảo mẫu </a> </li>
        <li class="bg_lo"> <a href="{{url ('/admin/view-coupons')}}"> <i class="icon icon-list"></i><span class="label label-info">{{count($posts)}}</span> Bài viết</a> </li>
            <li class="bg_ls"> <a href="{{url ('/admin/view-orders')}}"> <i class="icon-fullscreen"></i><span class="label label-warning">{{count($contracts)}}</span> Hợp đồng</a> </li>

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
        {{-- chart --}}
        <div class="row-fluid">
            <div class="span6">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                  <h5>Biểu đồ tài khoản trong hệ thống</h5>
                </div>
                <div class="widget-content">
                    <canvas id="pie-chart-acc" width="800" height="450"></canvas>
                </div>
              </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                    <h5>Biểu đồ tỉ lệ bài đăng</h5>
                  </div>
                  <div class="widget-content">
                      <canvas id="pie-chart-posts" width="800" height="450"></canvas>
                  </div>
                </div>
              </div>
        </div>
    {{-- end chart pie --}}
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                <h5>Biểu đồ thể hiện sự gia tăng người dùng trong hệ thống</h5>
                </div>
                <div class="widget-content">
                    <canvas id="line-chart-acc" width="500" height="150"></canvas>
                </div>
            </div>
            </div>
        </div>

      </div>
    </div>

    <!--end-main-container-part-->

{{-- script chart --}}
<script>
    // pie account
    new Chart(document.getElementById("pie-chart-acc"), {
        type: 'pie',
        data: {
        labels: ["Phụ huynh","Bảo mẫu","Quản trị"],
        datasets: [{
            label: "đơn vị (triệu người)",
            backgroundColor: ["lightblue","lightgreen","black"],
            data: [{{count($parents)}},{{count($sitters)}},1]
        }]
        },
        options: {
        title: {
            display: true,
            text: 'Biểu đồ tỷ lệ người dùng Phụ huynh và Bảo mẫu'
            }
        }
    });
    // pie posts
    new Chart(document.getElementById("pie-chart-posts"), {
        type: 'pie',
        data: {
        labels: ["Phụ huynh","Bảo mẫu"],
        datasets: [{
            label: "đơn vị (triệu người)",
            backgroundColor: ["lightblue","lightgreen"],
            data: [{{count($posts_parents)}},{{count($posts_sitters)}}]
        }]
        },
        options: {
        title: {
            display: true,
            text: 'Biểu đồ tỷ lệ Bài viết người dùng Phụ huynh và Bảo mẫu'
            }
        }
    });
    // line chart account
    new Chart(document.getElementById("line-chart-acc"), {
        type: 'line',
        data: {
            labels: ["T8/2020","T9/2020","T10/2020","T11/2020","T12/2020","T1/2021"],
            datasets: [{
                data: [0,3,3,5,6,{{count($parents_now)}}],
                label: "Phụ huynh",
                borderColor: "#3e95cd",
                fill: false
            }, {
                data: [0,2,5,7,11,{{count($sitters_now)}}],
                label: "Bảo mẫu",
                borderColor: "#8e5ea2",
                fill: false
            },
            ]
        },
        options: {
            title: {
            display: true,
            text: 'Đồ thị tăng trưởng người dùng trong hệ thống'
            }
        }
    });
</script>
@endsection
