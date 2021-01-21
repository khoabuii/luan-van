@extends('layouts.parentLayout.parent_app')
@section('title','profile')
@section('content')
<!-- Page Heading -->
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Thông tin người bảo mẫu</h1>
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
{{-- section update location --}}
@if(Session::has('success'))
    <script>
        alert('{{session('success')}}')
    </script>
@endif
@if(Session::has('errors'))
    <script>
        alert('{{session('errors')}}')
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
                        @foreach($img_sitter as $img)
                        <li>
                            <figure class="alignnone">
                                <img src="{{asset('/uploads/sitters_profile')}}/{{$img->img}}" width="250px" alt="">
                            </figure>
                        </li>
                        @endforeach
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
                            <li><a href="#tab1-3" data-toggle="tab">Kỷ năng</a></li>
                            <li><a href="#tab1-2" data-toggle="tab">Thông tin khác</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1-1">
                                <div class="">
                                    <h2 class="name">{{$sitter->name}} @if($sitter->status==1)<i class="fa fa-check" style="color: green"></i> @endif</h2>
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
                                        </li>
                                        <li><i class="fa fa-mars-double"></i> Giới tính:
                                            <span>
                                                @if($sitter->gender==0)
                                                    Nam
                                                @else Nữ
                                                @endif
                                            </span>
                                        </li>
                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{$sitter->created_at}}.</li>
                                        <li><i class="fa fa-money"></i>{{number_format($sitter->money)}} VND/Giờ</li>
                                        <li><i class="fa fa-line-chart"></i>
                                            @if($sitter->exp==0)
                                                Chưa có kinh nghiệm
                                            @else
                                                Có {{$sitter->exp}} năm Kinh nghiệm
                                            @endif
                                        </li>
                                        <li>
                                            <i class="fa fa-plus-square"></i>Điểm đánh giá TB:
                                            @if(count($feedback)!=0)
                                                <b>{{$avg_rate}} / 5 <i class="fa fa-star"></i></b>
                                            @endif
                                        </li>
                                    </ul>
                                    @Auth('parents')
                                        @if(count($contract_pending)!=0 || count($contract_active)!=0)
                                            <span style="color: rgb(182, 97, 27)">
                                                Bạn đã hoặc đang làm việc với người này, hãy đánh giá cho mọi người cùng biết nhé!
                                            </span>
                                        @endif
                                    @endAuth
                                    <div class="spacer-lg"></div>

                                    @auth('parents')
                                        @if(count($check)>0)
                                            <span class="btn btn-primary fa fa-check"> Đã lưu</span>
                                        @else
                                    <a href="{{asset('parent/save_sitters')}}/{{$sitter->id}}" class="btn btn-primary"><span class="fa fa-user-plus"></span> Lưu</a>
                                        @endif
                                    <button type="button"
                                    @if(count($contract_pending)!=0 || count($contract_active)!=0) disabled @endif
                                    class="btn btn-primary" data-toggle="modal" data-target="#contract">
                                        <span class="fa fa-send"></span> Gửi yêu cầu làm việc
                                    </button>
                                    <a href="{{asset('parent/chat')}}/{{$sitter->id}}" class="btn btn-primary">
                                        <span class="fa fa-inbox"></span>Chat
                                    </a>

                                    <a href="{{asset('parent/posts/sitter')}}/{{$sitter->id}}" class="btn btn-primary">
                                        <span class="fa fa-newspaper-o"></span>Bài viết
                                    </a>
                                @endAuth
                            </div>
                        </div>
                        @auth
                        <!-- modal contract -->
                            <div class="modal fade" id="contract" tabindex="-1" role="dialog" aria-labelledby="contract" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Nội dung ký kết</h5>
                                    </div>
                                    <div class="modal-body">
                                    Bên A: <b>{{Auth::guard('parents')->user()->name}}</b>
                                    (có ID người dùng: <b>{{Auth::guard('parents')->user()->id}}</b>) là ngưởi gửi yêu cầu làm việc với bên B
                                    <br>
                                    Bên B: <b>{{$sitter->name}}</b>( có ID người dùng: <b>{{$sitter->id}}</b>) sẽ xem yêu cầu kí kết hợp đồng
                                    <br>
                                    Giá: <b>{{number_format($sitter->money)}}</b> VND/Buổi (Có thể tự thỏa thuận)
                                    <br>
                                    Chúng tôi chỉ cung cấp nền tảng, mọi vấn đề xảy ra chúng tôi sẽ không chịu trách nhiệm.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{asset('parent/contract/sendRequest')}}/{{$sitter->id}}" class="btn btn-primary">Xác nhận</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <!-- end modal-->
                        @endAuth

                        <div class="tab-pane fade" id="tab1-3">
                            <div class="row">
                                @foreach($sitter_skill as $skill)
                                <div class="col-sm-3 col-md-3">
                                    <h4>{{$skill->name}}</h4>
                                </div>
                                @endforeach
                            </div>
                        </div>
                            <div class="tab-pane fade" id="tab1-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Email liên hệ</h4>
                                        <div class="list list__arrow">
                                            {{$sitter->email}}
                                        </div>
                                        <br>
                                        <h4>Số điện thoại</h4>
                                        <div class="list list__arrow">
                                            {{$sitter->phone}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Quê quán</h4>
                                        <div class="list list__arrow2">
                                            {{$sitter->address}}
                                        </div>
                                        <br>
                                        <h4>Ngày sinh</h4>
                                        <div class="list list__arrow2">
                                            {{$sitter->birthDay}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Học vấn</h4>
                                        <div class="list list__arrow2">
                                            {{$sitter->education}}
                                        </div>
                                        <br>
                                        <h4>Trạng thái</h4>
                                        <div class="list list__arrow2">
                                            @if($sitter->status==0)
                                                Chưa xác thực
                                            @elseif($sitter->status==1)
                                                Đã xác thực
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
                {{$sitter->description}}
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
        <h3><a id="action" href="#action">Hoạt động </a></h3>
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
        @Auth('parents')
        <h3 id="feedback_sitter"><a href="#feedback_sitter">Đánh giá</a>
            @if(count($contract_active)!=0)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedback">
                    @if(count($check_feedback)>0)Chỉnh sửa nhận xét của bạn @else Gửi đánh giá của bạn @endif
                </button>
            @endif
            </h3>
        <small style="color: rgb(66, 25, 25)">Lưu ý: Mỗi người chỉ có thể đánh giá duy nhất 1 lần</small>
        <!-- modal feedback -->
        <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedback" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="feedback">Gửi nhận xét của bạn về người này</h5>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{asset('parent/rate_sitter')}}/{{$sitter->id}}" method="POST">
                      {{csrf_field()}}
                    <div class="form-group">
                        <span style="color: black">Bạn đánh giá về người này như thế nào:
                        <input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
                        <label class="star star-1" for="star-1"></label>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label" >Nội dung chi tiết:</label>
                      <textarea class="form-control" id="ckeditor" name="description" cols="50"></textarea>
                      <script>CKEDITOR.replace( 'ckeditor' );</script>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Gửi nhận xét</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- end modal feedback-->
          @foreach($feedback as $feed)
        <div class="row" style="background-color:rgb(245, 245, 245)">
            <div class="col-md-2">
                <div class="">
                    <div class="job-listing-box">
                        <div class="job-listing-img">
                            <img src="{{asset('uploads/parents_profile')}}/{{$feed->avatar}}" width="200px" alt="">
                        </div>
                        <div>
                            <div class="name"><center><a href="#">{{$feed->name}}</a>
                                @if(count($check_feedback) ==0)

                                @elseif($feed->parent == $check_feedback[0]->parent)
                                    <span style="color: black">(Bạn)</span>
                                @endif
                            </center></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <br>
                <h6>
                    @if($feed->rate_sitter==1)
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
                @if(count($check_feedback) ==0)
                @elseif($feed->parent == $check_feedback[0]->parent)
                    &nbsp;
                    <button onclick="return delete_feedback_{{$feed->id}}();">
                        <span>Xóa</span>
                    </button>
                @endif
            </div>
        </div> <br>
        <script>
            function delete_feedback_{{$feed->id}}(){
                $.ajax({
                    type:'GET',
                    url:'{{asset('parent/delete_feedback')}}/{{$feed->id}}',
                    success:function(data){
                        location.reload();
                    }
                });
            }
        </script>
        @endforeach
        @endAuth
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

 <!-- Google map Map Init-->
<!-- Google maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqLMWBABFRGf932Y9dmmmby1mIrpL1-DQ&callback=initMap&libraries=places&v=weekly" defer></script>
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
<!-- end map -->
@endsection
