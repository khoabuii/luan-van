@extends('layouts.sittersLayout.sitter_app')
@section('title','profile')
@section('content')
<!-- Page Heading -->
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Thông tin Phụ huynh</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="#">Phụ huynh</a></li>
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
{{-- end section update location --}}
@if(Session::has('errors'))
    <script>
        alert('{{session('errors')}}')
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
                                <img src="{{asset('/uploads/parents_profile')}}/{{$parent->avatar}}" width="250px" alt="">
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
                                        <li>Phụ huynh</li>
                                    </ul>
                                    <ul class="info">
                                        <li><i class="fa fa-map-marker"></i>
                                            @if(count($location)>0)
                                                {{$location[0]->address}}
                                            @else
                                                Chưa thiết lập địa chỉ
                                            @endif
                                        </li>

                                        <li><i class="fa fa-clock-o"></i> Tham gia vào {{$parent->created_at}}.</li>
                                        <li>
                                            <i class="fa fa-plus-square"></i>Điểm đánh giá TB:
                                            @if(count($feedback)!=0)
                                                <b>{{$avg_rate}} / 5 <i class="fa fa-star"></i></b>
                                            @endif
                                        </li>
                                        <li>
                                            <i class="fa fa-child"></i> Có {{$parent->child}} người con
                                        </li>
                                    </ul>
                                    @auth
                                        @if(count($contract_pending)!=0 || count($contract_active)!=0)
                                            <span style="color: rgb(182, 97, 27)">
                                                Bạn đã hoặc đang làm việc với người này, hãy đánh giá cho mọi người cùng biết nhé!
                                            </span>
                                        @endif
                                    @endAuth
                                    <div class="spacer-lg"></div>
                                @auth
                                <button type="button"
                                @if(count($contract_pending)!=0 || count($contract_active)!=0) disabled @endif
                                class="btn btn-primary" data-toggle="modal" data-target="#contract">
                                    <span class="fa fa-send"></span> Gửi yêu cầu làm việc
                                </button>
                                <a href="{{asset('sitter/chat')}}/{{$parent->id}}" class="btn btn-primary">
                                    <span class="fa fa-inbox"></span>Chat
                                </a>

                                <a href="{{asset('sitter/posts/parent')}}/{{$parent->id}}" class="btn btn-primary">
                                    <span class="fa fa-pencil"></span>Bài đăng
                                </a>
                                @endAuth
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
                                          Bên A: <b>{{Auth::user()->name}}</b> (có ID người dùng: <b>{{Auth::user()->id}}</b>) là ngưởi gửi yêu cầu làm việc với bên B
                                          <br>
                                          Bên B: <b>{{$parent->name}}</b>( có ID người dùng: <b>{{$parent->id}}</b>) sẽ xem yêu cầu kí kết hợp đồng
                                          <br>
                                          Giá: <b>{{number_format(Auth::user()->money)}}</b> VND/Buổi (Có thể tự thỏa thuận)
                                          <br>
                                          Chúng tôi chỉ cung cấp nền tảng, mọi vấn đề xảy ra chúng tôi sẽ không chịu trách nhiệm.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <a href="{{asset('sitter/contract/sendRequest/')}}/{{$parent->id}}" class="btn btn-primary">Xác nhận</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!-- end modal-->
                                @endAuth
                            </div>
                            <div class="tab-pane fade" id="tab1-2">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Email liên hệ</h4>
                                        <div class="list list__arrow">
                                            {{$parent->email}}
                                        </div>
                                        <br>
                                        <h4>Số điện thoại</h4>
                                        <div class="list list__arrow">
                                            {{$parent->phone}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Quê quán</h4>
                                        <div class="list list__arrow2">
                                            {{$parent->address}}
                                        </div>
                                        <br>
                                        <h4>Ngày sinh</h4>
                                        <div class="list list__arrow2">
                                            {{$parent->birthDay}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabs / End -->
                </div>
            </div>
        </div>

        {{-- <div class="spacer-xl"></div> --}}

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
        <h3><a id="action" href="#action">Khung thời gian cần tìm người giữ trẻ </a></h3>
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
        @auth
        <h3 id="feedback_parent"><a href="#feedback_parent">Đánh giá</a>
            @if(count($contract_active)!=0)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedback">Gửi đánh giá của bạn</button>
            @endif
        </h3>
        <!-- modal feedback -->
        <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedback" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="feedback">Gửi nhận xét của bạn về người này</h5>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{asset('sitter/feedback_parent')}}/{{$parent->id}}" method="POST">
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
                      <label for="message-text" class="col-form-label">Nội dung chi tiết:</label>
                      <textarea class="form-control" name="description" id="ckeditor" cols="50"></textarea>
                      <script>
                         CKEDITOR.replace( 'ckeditor' );
                      </script>
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
                              <img src="{{asset('uploads/sitters_profile')}}/{{$feed->images}}" width="200px" alt="">
                          </div>
                          <div>
                              <div class="name"><center><a href="#">{{$feed->name}}</a>
                                  @if(count($check_feedback)==0 )

                                  @elseif($feed->sitter == $check_feedback[0]->sitter)
                                      <span style="color: black">(Bạn)</span>
                                  @endif
                              </center></div>
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
                  @if(count($check_feedback)==0)
                  @elseif($feed->sitter == $check_feedback[0]->sitter)
                    &nbsp;  <button onclick="return delete_feedback_{{$feed->id}}();"><span>Xóa</span></button>
                  @endif
              </div>
          </div> <br>
          <script>
              function delete_feedback_{{$feed->id}}(){
                  $.ajax({
                      type:'GET',
                      url:'{{asset('sitter/delete_feedback')}}/{{$feed->id}}',
                      success:function(data){
                          location.reload();
                      }
                  });
              }
          </script>
          @endforeach
        @endauth
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

 <!-- Map Init-->
 <script>
    var mapObj = null;
    var defaultCoord = [10.0352419,105.7773227]; // coord mặc định, 9 giữa HCMC
    var zoomLevel = 13;
    var mapConfig = {
        attributionControl: false, // để ko hiện watermark nữa
        center: defaultCoord, // vị trí map mặc định hiện tại
        zoom: zoomLevel, // level zoom
    };
    window.onload = function() {
        // init map
        mapObj = L.map('map_canvas', {attributionControl: false}).setView(defaultCoord, zoomLevel);

        // add tile để map có thể hoạt động, xài free từ OSM
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapObj);
        L.marker([10.0344379,105.770484]).addTo(mapObj);
    };

</script>
<!-- end map -->
@endsection
