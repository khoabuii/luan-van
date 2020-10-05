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
@if(Session::has('errors'))
    <script>
        alert('{{session('errors')}}')
    </script>
@endif

@if(Session::has('update'))
    <script>
        alert('{{session('update')}}')
    </script>
@endif
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="flexslider carousel">
                    <ul class="slides">
                        <li>
                            <figure class="alignnone">
                                <img src="{{asset('/uploads/parents_profile')}}/{{Auth::guard('parents')->user()->avatar}}" width="350px" alt="">
                            </figure>
                        </li>
                    </ul>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#imagesProfile"><span class="fa fa-picture-o"> Cập nhật ảnh đại diện</span></button>
                </div>
                <!-- Modal img -->
                <div class="modal fade" id="imagesProfile" tabindex="-1" role="dialog" aria-labelledby="imagesProfile" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagesProfile">Cập nhật hình ảnh</h5>
                            </div>
                            <form action="{{asset('parent/profile/image_update')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-body">
                                <fieldset class="fieldset-company_logo">
                                    <label for="company_logo">Cập nhật hình ảnh mới</label>
                                    <div class="field">
                                        <input type="file" class="form-control hidden" name="image" id="img" onchange="changeImg(this)"/>
                                        <img id="avatar" class="thumbnail" width="140px" src="{{asset('homepage/images/seo.png')}}">
                                    </div>
                                </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- end Modal img-->
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
                                        <li><i class="fa fa-map-marker"></i>
                                            @if(count($location)>0)
                                                {{$location[0]->address}}
                                            @else
                                                Chưa thiết lập địa chỉ
                                            @endif
                                            <button class="btn btn-small" data-toggle="modal" data-target="#location">Cập nhật</button></li>
                                         <!-- Modal location -->
                                         <div class="modal fade bd-example-modal-lg" id="location" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{asset('parent/profile/location_update')}}" method="post">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="imagesProfile"><center>Cập nhật vị trí</center></h4>
                                                </div>
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for=""><small>Tỉnh /Thành phố</small></label> <br>
                                                                    <select class="form-control" name="provinces">
                                                                        <option value="">Chọn Tỉnh/TP</option>
                                                                            @foreach($address as $add)
                                                                        <option value="{{$add->id}}">{{$add->name}}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label><small>Huyện /Quận</small></label> <br>
                                                                    <select class="form-control" name="districts">
                                                                        <option value="">Chọn Huyện/Quận</option>
                                                                        @if(!empty($districts))
                                                                            @foreach($districts as $key=>$value)
                                                                                <option value="{{$key}}">{{$value}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for=""><small>Xã /Phường</small></label> <br>
                                                                    <select class="form-control" name="wards">
                                                                        <option value="">Chọn Xã/Phường</option>
                                                                        @if(!empty($wards))
                                                                        @foreach($wards as $key=>$value)
                                                                            <option value="{{$key}}">{{$value}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        <!--end modal location-->
                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{Auth::guard('parents')->user()->created_at}}.</li>
                                    </ul>
                                    <div class="spacer-lg"></div>
                                    <a href="{{asset('parent/profile/posts')}}" class="btn btn-primary">
                                        <span class="fa fa-pencil-square-o"></span>
                                        Quản lý bài viết
                                    </a>
                                    <a href="#" class="btn btn-primary"><span class="fa fa-sliders"></span>Update tài khoản</a>
                                    <a href="{{asset('parent/delete_account')}}"
                                 onclick="return confirm('Khi bạn xóa mọi dữ liệu sẽ không còn trong hệ thống. Bạn có chắc chắn chưa?')"
                                  class="btn btn-danger"><span class="fa fa-user-times"></span> Xóa tài khoản</a>
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
        <div class="spacer-xl"></div>
        <h3><a href="#feedback">Đánh giá</a></h3>
        <div class="row" style="background-color:rgb(245, 245, 245)">
            <div class="col-md-2">
                <div class="">
                    <div class="job-listing-box">
                        <figure class="job-listing-img">
                            <img src="{{asset('uploads/sitters_profile/u3yURYlAj4etVyOtkeSHgxqf8qIOE1f2GMaazq5T.jpeg')}}" alt="">
                        </figure>
                        <div>
                            <div class="name"><center><a href="#">Bui Van Khoa</a></center></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h6> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></h6>
                <h6 style="color: black">Hello sdhggggggggggggg sdhhh ssagsagsa sgagsgsasfasfas dsff ddf</h6>
                <span>Đăng vào 2 ngày trước</span>
            </div>
        </div>
        <br>
        <div class="row" style="background-color:rgb(245, 245, 245)">
            <div class="col-md-2">
                <div class="">
                    <div class="job-listing-box">
                        <div class="job-listing-img">
                            <img src="{{asset('uploads/sitters_profile/u3yURYlAj4etVyOtkeSHgxqf8qIOE1f2GMaazq5T.jpeg')}}" width="200px" alt="">
                        </div>
                        <div>
                            <div class="name"><center><a href="#">Bui Van Khoa</a></center></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h6> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></h6>
                <h6 style="color: black">Hello sdhggggggggggggg sdhhh ssagsagsa sgagsgsasfasfas dsff ddf</h6>
                <span>Đăng vào 2 ngày trước</span>
            </div>
        </div>
    </div>
</section>
<!-- Page Content / End -->
{{-- upload images --}}
<script>
    function changeImg(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#avatar').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#avatar').click(function(){
            $('#img').click();
        });
    });
</script>

{{-- ajax address --}}
<script type="text/javascript">
    var url_districts = "{{ url('/showDistricts')}}";
    var url_wards = "{{ url('/showWards')}}";
    // show districts
    $("select[name='provinces']").change(function(){
        var province_id = $(this).val();
        // console.log(province_id);
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url_districts,
            method: 'POST',
            data: {
                province_id: province_id,
                _token: token
            },
            success: function(data) {
                $("select[name='districts'").html('');
                $.each(data, function(key, value){
                    $("select[name='districts']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
    //end show district

    // show wards
    $("select[name='districts']").change(function(){
        var district_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url_wards,
            method: 'POST',
            data: {
                district_id: district_id,
                _token: token
            },
            success: function(data) {
                $("select[name='wards'").html('');
                $.each(data, function(key, value){
                    $("select[name='wards']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
</script>
{{-- end ajax address --}}
@endsection
