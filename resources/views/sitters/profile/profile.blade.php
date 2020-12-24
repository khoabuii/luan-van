@extends('layouts.sittersLayout.sitter_app')
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
<!-- section delete img-->
@if(Session::has('delete'))
    <script>
        alert('{{session('delete')}}')
    </script>
@endif
<!-- end section delete img-->
{{-- section update location --}}
@if(Session::has('update'))
    <script>
        alert('{{session('update')}}')
    </script>
@endif
{{-- end section update location --}}
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="flexslider carousel">
                    <ul class="slides">
                        @foreach($img as $img)
                        <li>
                            <figure class="alignnone">
                                <img src="{{asset('/uploads/sitters_profile')}}/{{$img->img}}" width="250px" alt="">
                                <a href="{{asset('/sitter/profile/images_delete')}}/{{$img->img}}" class="fa fa-remove">Xóa ảnh này khỏi album</a>
                            </figure>
                        </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#imagesProfile"><span class="fa fa-picture-o"> Quản lý hình ảnh</span></button>
                </div>
                <!-- Modal img -->
                    <div class="modal fade" id="imagesProfile" tabindex="-1" role="dialog" aria-labelledby="imagesProfile" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imagesProfile">Quản lý hình ảnh</h5>
                                </div>
                                <form action="{{asset('sitter/profile/images')}}" method="post" enctype="multipart/form-data">
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
                            <li><a href="#tab1-3" data-toggle="tab">Các kỷ năng</a></li>
                            <li><a href="#tab1-2" data-toggle="tab">Thông tin khác</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1-1">
                                <div class="">
                                    <h2 class="name">{{Auth::user()->name}}
                                    @if(Auth::user()->status==1)
                                    <i class="fa fa-check" style="color: green"></i>
                                    @endif
                                    </h2>
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
                                                <form action="{{asset('sitter/profile/location_update')}}" method="post">
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

                                        <li><i class="fa fa-mars-double"></i> Giới tính:
                                            <span>
                                                @if(Auth::user()->gender==0)
                                                    Nam
                                                @else Nữ
                                                @endif
                                            </span>
                                        </li>
                                        <li><i class="fa fa-money"></i>{{number_format(Auth::user()->money)}} VND/Buổi</li>
                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{Auth::user()->created_at}}.</li>
                                    </ul>

                                    <div class="spacer-lg"></div>

                                <a href="{{asset('sitter/profile/update_info')}}" class="btn btn-primary "><span class="fa fa-sliders"></span> Cập nhật tài khoản</a>
                                <a href="{{asset('sitter/delete_account')}}"
                                 onclick="return confirm('Khi bạn xóa mọi dữ liệu sẽ không còn trong hệ thống. Bạn có chắc chắn chưa?')" class="btn btn-danger"><span class="fa fa-user-times"></span> Xóa tài khoản</a>
                                 <a href="{{asset('sitter/contract')}}" class="btn btn-primary "><span class="fa fa-file-word-o"></span> Quản lý hợp đồng </a>
                                 <br> <br>
                                 <a href="{{asset('sitter/posts/me')}}" class="btn btn-primary "><span class="fa fa-archive"></span> Quản lý Bài viết </a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab1-3">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        @foreach($my_skill as $skill)
                                            <h4>{{$skill->name}}</h4>
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{Route('addSkill')}}" method="get" >
                                            {{csrf_field()}}
                                            <select multiple="multiple" name="skill[]" id="skill" class="form-control">
                                                @foreach($skills as $skill)
                                                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-sm-1 col-md-1">
                                        <input type="submit" value="Xác nhận">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab1-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Email liên hệ</h4>
                                        <div class="list list__arrow">
                                            {{Auth::user()->email}}
                                        </div>
                                        <br>
                                        <h4>Số điện thoại</h4>
                                        <div class="list list__arrow">
                                            {{Auth::user()->phone}}
                                        </div>
                                        <br>
                                        <h4>Kinh nghiệm</h4>
                                        <div class="list list__arrow">
                                            @if(Auth::user()->exp==0)
                                            Chưa có kinh nghiệm
                                            @elseif(Auth::user()->exp==1)
                                            Dưới 1 năm kinh nghiệm
                                            @elseif(Auth::user()->exp==2)
                                            1-2 năm
                                            @elseif(Auth::user()->exp==3)
                                            3 năm kinh nghiệm
                                            @elseif(Auth::user()->exp==4)
                                            4 năm Kinh nghiệm
                                            @elseif(Auth::user()->exp==5)
                                            5 năm kinh nghiệm
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Quê quán</h4>
                                        <div class="list list__arrow2">
                                            {{Auth::user()->address}}
                                        </div>
                                        <br>
                                        <h4>Ngày sinh</h4>
                                        <div class="list list__arrow2">
                                            {{Auth::user()->birthDay}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Học vấn</h4>
                                        <div class="list list__arrow2">
                                            {{Auth::user()->education}}
                                        </div>
                                        <br>
                                        <h4>Trạng thái</h4>
                                        <div class="list list__arrow2">
                                            @if(Auth::user()->status==0)
                                                Chưa duyệt
                                            @elseif(Auth::user()->status==1)
                                                Đã duyệt
                                            @else
                                                Đã bị khóa
                                            @endif
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
                {{Auth::user()->description}}
            </div>
            <div class="col-md-6">
                <h3>Địa điểm hoạt động</h3>
                <div class="job-location">
                    <!-- Google Map -->
                    <div class="googlemap-wrapper">
                        <div id="map" class="map-canvas"></div>
                    </div>
                    <!-- Google Map / End -->
                </div>
            </div>
        </div>

        <div class="spacer-xl"></div>

        <!-- Person Availability -->
        <h3><a id="action" href="#action">Hoạt động </a><button type="button" class="btn btn-small" data-toggle="modal" data-target="#activity">
            Cập nhật
          </button></h3>
          <!-- Modal activity -->
        <div class="modal fade" id="activity" tabindex="-1" role="dialog" aria-labelledby="activity" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật lịch làm việc</h5>
                </div>
                <div class="modal-body">
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
                             <form action="{{route('post.update_work')}}" method="post">
                                    {{csrf_field()}}
                                <tr>
                                    <td class="time">Buổi Sáng</td>
                                    <td><input type="checkbox" name="time1" value="1"></td>
                                    <td><input type="checkbox" name="time2" value="1"></td>
                                    <td><input type="checkbox" name="time3" value="1"></td>
                                    <td><input type="checkbox" name="time4" value="1"></td>
                                    <td><input type="checkbox" name="time5" value="1"></td>
                                    <td><input type="checkbox" name="time6" value="1"></td>
                                    <td><input type="checkbox" name="time7" value="1"></td>
                                </tr>
                                <tr>
                                    <td class="time">Buổi chiều</td>
                                    <td><input type="checkbox" name="time8" value="1"></td>
                                    <td><input type="checkbox" name="time9" value="1"></td>
                                    <td><input type="checkbox" name="time10" value="1"></td>
                                    <td><input type="checkbox" name="time11" value="1"></td>
                                    <td><input type="checkbox" name="time12" value="1"></td>
                                    <td><input type="checkbox" name="time13" value="1"></td>
                                    <td><input type="checkbox" name="time14" value="1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end modal activity -->
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
                    @if(count($activity)>0)
                    <tr>
                        <td class="time">Buổi Sáng</td>
                        <td>
                            @if($activity[0]->session1==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session2==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session3==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session4==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session5==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session6==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session7==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="time">Buổi chiều</td>
                        <td>
                            @if($activity[0]->session8==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session9==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session10==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session11==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session12==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session13==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                        <td>
                            @if($activity[0]->session14==1)
                            <i class="fa fa-circle"></i>
                            @endif
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="table-schedule-legend text-right">
            <i class="fa fa-circle"></i> &nbsp; Thời gian làm việc
        </div>
        <!-- Person Availability / End -->
        <div class="spacer-xl"></div>
        <h3 id="#feedback_sitter"><a href="#feedback_sitter">Đánh giá</a></h3>
        @foreach($feedback as $feed)
        <div class="row" style="background-color:rgb(245, 245, 245)">
            <div class="col-md-2">
                <div class="">
                    <div class="job-listing-box">
                        <div class="job-listing-img">
                            <img src="{{asset('uploads/parents_profile')}}/{{$feed->avatar}}" width="200px" alt="">
                        </div>
                        <div>
                            <div class="name">
                                <center>
                                <a href="{{asset('sitter/parent_profile')}}/{{$feed->id_parent}}">{{$feed->name}}</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <br>
                <h6>@if($feed->rate_sitter==1)
                    <i class="fa fa-star"></i>
                    @elseif($feed->rate_sitter==2)
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    @elseif($feed->rate_sitter==3)
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @elseif($feed->rate_sitter==4)
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @else
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    @endif
                </h6>
                <h6 style="color: black">{!!$feed->content_sitter !!}</h6>
                <span>Đăng vào {{date_diff(date_create($feed->updated_at), date_create('now'))->d}} ngày trước</span>
            </div>
        </div> <br>
        @endforeach
            <center><small>{{$feedback->links()}}</small></center>
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

{{-- Google map api --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqLMWBABFRGf932Y9dmmmby1mIrpL1-DQ&callback=initMap&libraries=places&v=weekly" async defer></script>
<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {lat: 10.0248, lng: 105.7667051},
        zoom: 11
    });
    }
    const marker = new google.maps.Marker({
        map: map,
        position: {lat: 10.0248, lng: 105.7667051},
    });

</script>

@endsection
