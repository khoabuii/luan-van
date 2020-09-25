@extends('layouts.parentLayout.parent_app')
@section('title','profile')
@section('content')
<!-- Page Heading -->
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Thông tin cá nhân</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="#">Babysitters</a></li>
                    <li class="active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Page Heading / End -->
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="flexslider carousel">
                    <ul class="slides">
                        <li>
                            <figure class="alignnone">
                                <img src="{{asset('homepage/images/samples/bsitter-1.jpg')}}" width="350px" alt="">
                            </figure>
                        </li>
                        <li>
                            <figure class="alignnone">
                                <img src="{{asset('homepage/images/samples/bsitter-2.jpg')}}" width="350px" alt="">
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-7">
                <div class="job-profile-info">
                    <!-- Tabs -->
                    <div class="tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1-1" data-toggle="tab">Thông tin chính</a></li>
                            <li><a href="#tab1-2" data-toggle="tab">Thông tin khác</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1-1">
                                <div class="">
                                    <h2 class="name">{{Auth::guard('parents')->user()->name}}</h2>
                                    <i class="tagline"> </i>
                                    <ul class="meta">
                                        <li>Bảo mẫu</li>
                                        <li>Babysitter</li>
                                    </ul>
                                    <ul class="info">
                                        <li><i class="fa fa-map-marker"></i> Looking within 20 miles of <a href="#">London, UK</a></li>

                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{Auth::guard('parents')->user()->created_at}}.</li>
                                    </ul>
                                    <div class="spacer-lg"></div>

                                    <a href="#" class="btn btn-primary btn-lg"><span class="fa fa-sliders"></span> Cập nhật tài khoản</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab1-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Email liên hệ</h4>
                                        <div class="list list__arrow">
                                            {{Auth::guard('parents')->user()->email}}
                                        </div>
                                        <br>
                                        <h4>Số điện thoại</h4>
                                        <div class="list list__arrow">
                                            {{Auth::guard('parents')->user()->phone}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Quê quán</h4>
                                        <div class="list list__arrow2">
                                            {{-- {{Auth::user()->address}} --}}
                                        </div>
                                        <br>
                                        <h4>Ngày sinh</h4>
                                        <div class="list list__arrow2">
                                            {{Auth::guard('parents')->user()->birthDay}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Học vấn</h4>
                                        <div class="list list__arrow2">
                                            {{-- {{Auth::user()->education}} --}}
                                        </div>
                                        <br>
                                        <h4>Trạng thái</h4>
                                        <div class="list list__arrow2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabs / End -->
                </div>

            </div>
        </div>

        <div class="spacer-xl"></div>

        <div class="row">
            <div class="col-md-6">
                <h3>Mô tả chi tiết</h3>
                {{Auth::guard('parents')->user()->description}}
            </div>
            <div class="col-md-6">
                <h3>Địa điểm hoạt động</h3>
                <div class="job-location">
                    <!-- Google Map -->
                    <div class="googlemap-wrapper">
                        <div id="map_canvas" class="map-canvas"></div>
                    </div>
                    <!-- Google Map / End -->
                </div>
            </div>
        </div>

        <div class="spacer-xl"></div>

        <!-- Person Availability -->
        <h3>Thời gian cần tìm người phụ giúp</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-schedule">
                <thead>
                    <th class="empty"></th>
                    <th>Thứ 2</th>
                    <th>Thứ 3</th>
                    <th>Thứ 4</th>
                    <th>Thứ 5</th>
                    <th>Thứ 6</th>
                    <th>Thứ 7</th>
                    <th>Chủ nhật</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="time">Buổi Sáng</td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="time">Buổi chiều</td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                        <td><i class="fa fa-circle"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-schedule-legend text-right">
            <i class="fa fa-circle"></i> &nbsp; Thời gian làm việc
        </div>
        <!-- Person Availability / End -->

    </div>
</section>
<!-- Page Content / End -->
@endsection
