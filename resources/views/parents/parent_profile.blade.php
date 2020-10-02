@extends('layouts.parentLayout.parent_app')
@section('title','Profile')
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
                    <li><a href="#">Home</a></li>
                    <li class="active">Profile Phụ huynh</li>
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
                                <img src="{{asset('/uploads/parents_profile')}}/{{$parent->avatar}}" width="350px" alt="">
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
                                    <h2 class="name">{{$parent->name}}</h2>
                                    <i class="tagline"> </i>
                                    <ul class="meta">
                                        <li>Home</li>
                                        <li>Parent</li>
                                    </ul>
                                    <ul class="info">
                                        <li><i class="fa fa-map-marker"></i>
                                            {{-- @if(count($location)>0)
                                                {{$location[0]->address}}
                                            @else
                                                Chưa thiết lập địa chỉ
                                            @endif --}}
                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{$parent->created_at}}.</li>
                                    </ul>
                                    <div class="spacer-lg"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab1-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Email liên hệ</h4>
                                        <div class="list list__arrow">
                                            ************
                                        </div>
                                        <br>
                                        <h4>Số điện thoại</h4>
                                        <div class="list list__arrow">
                                            **********
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
                                            {{$parent->birthDay}}
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
                {{$parent->description}}
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
        <div class="spacer-xl"></div>
        <h3><a href="#feedback">Đánh giá</a></h3>
        @foreach($feedback as $feed)
        <div class="row" style="background-color:rgb(245, 245, 245)">
            <div class="col-md-2">
                <div class="">
                    <div class="job-listing-box">
                        <div class="job-listing-img">
                            <img src="{{asset('uploads/sitters_profile')}}/{{$feed->images}}" width="200px" alt="">
                        </div>
                        <div>
                            <div class="name">
                                <center><a href="#">{{$feed->name}}</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <br>
                <h6>@if($feed->rate_parent==1)
                    <i class="fa fa-star"></i>
                    @elseif($feed->rate_parent==2)
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    @elseif($feed->rate_parent==3)
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @elseif($feed->rate_parent==4)
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @else
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @endif
                </h6>
                <h6 style="color: black">{!!$feed->content_parent !!}</h6>
                <span>Đăng vào {{date_diff(date_create($feed->updated_at), date_create('now'))->d}} ngày trước</span>
            </div>
        </div> <br>
        @endforeach
    </div>
</section>
<!-- Page Content / End -->
@endsection
