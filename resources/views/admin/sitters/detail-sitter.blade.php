@extends('layouts.adminLayout.admin_design')
@section('title','Xem danh sách người bảo mẫu')
@section('content')

<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sitters</a> <a href="#" class="current">Xem chi tiết</a> </div>
      <h1>Chi tiết bảo mẫu</h1>

      @include('noti.errors')
      @include('noti.success')
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon icon-eye-open"></i> </span>
              <h5 >{{$sitter->name}}</h5>
            </div>
            <div class="widget-content">
              <div class="row-fluid">
                <div class="span4">
                    <img src="{{asset('uploads/sitters_profile/')}}/{{$sitter->images}}" width="100%">
                </div>
                {{-- <br> --}}
                <div class="span8">
                  <table class="table table-bordered table-invoice">
                    <tbody>
                      <tr>
                      <tr>
                        <td class="width30">Họ tên:</td>
                        <td class="width70"><strong>{{$sitter->name}}</strong></td>
                      </tr>
                      <tr>
                        <td>Ngày sinh:</td>
                        <td><strong>{{$sitter->birthDay}}</strong></td>
                      </tr>
                      <tr>
                        <td>Giới tính</td>
                        <td><strong>@if($sitter->gender==0) Nam @else Nữ @endif</strong></td>
                      </tr>
                      <tr>
                        <td class="width30">Quê quán</td>
                         <td class="width70"><strong>{{$sitter->address}}</strong> </td>
                      </tr>
                    <tr>
                        <td class="width30">Nơi làm việc</td>
                        <td class="width70">
                            @if(count($address) !=0)
                                <strong>{{$address[0]->address}}</strong>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="width30">Email</td>
                        <td class="width70"><strong>{{$sitter->email}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Số điện thoại</td>
                        <td class="width70"><strong>{{$sitter->phone}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Trình độ học vấn</td>
                        <td class="width70"><strong>{{$sitter->education}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Trạng thái</td>
                        <td class="width70">
                            <strong>
                                <div class="btn-group">
                                    @if($sitter->status==0)
                                     <button class="btn btn-warning">
                                       Chưa Xác thực
                                    @elseif($sitter->status==1)
                                    <button class="btn btn-success">
                                        Đã xác thực
                                    @elseif($sitter->status==2)
                                    <button class="btn btn-danger">
                                        Bị khóa
                                    @endif
                                    </button>
                                        <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Chưa kiểm duyệt</a></li>
                                        <li><a href="#">Xác thực</a></li>
                                        <li><a href="#">Khóa</a></li>
                                    </ul>
                                </div>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="width30">Tiền hoa hồng</td>
                        <td class="width70"><strong>{{number_format($sitter->money)}} VND/Buổi</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Mô tả chi tiết</td>
                        <td class="width70"><strong>{{$sitter->description}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Tham gia vào lúc</td>
                        <td class="width70"><strong>{{$sitter->created_at}}</strong> </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- end modal activity -->
              <h4>Hoạt động</h4>
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
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session2==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session3==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session4==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session5==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session6==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session7==1)
                                    <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="time">Buổi chiều</td>
                                <td>
                                    @if($activity[0]->session8==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session9==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session10==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session11==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session12==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session13==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($activity[0]->session14==1)
                                        <i class="icon icon-asterisk"></i>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="table-schedule-legend text-right">
                    <i class="icon icon-asterisk"></i> &nbsp; Thời gian có thể làm việc làm việc
                </div>
                <!-- Person Availability / End -->
              <h4 id="feedback">Đánh giá từ phụ huynh</h4>
              <div class="row-fluid">
                <div class="span12">
                  <table class="table table-bordered table-invoice-full">
                    <thead>
                      <tr>
                        <th class="span3">Phụ huynh</th>
                        <th class="span8">Nội dung</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($feedback as $feed)
                        <tr>
                            <td>
                                <center><img src="{{asset('uploads/parents_profile/')}}/{{$feed->avatar}}"width="50%"></center>
                                <center><a href="{{asset('admin/parents/detail/')}}/{{$feed->id_parent}}">
                                    <h5>{{$feed->name}}</h5>
                                </a></center>
                            </td>
                            <td>
                                <span>Điểm đánh giá:
                                    @if($feed->rate_sitter==1)
                                        <i class="icon icon-star"></i>
                                    @elseif($feed->rate_sitter==2)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @elseif($feed->rate_sitter==3)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @elseif($feed->rate_sitter==4)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @else
                                    <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @endif
                                </span>
                                <p>
                                    {!! $feed->content_sitter !!}
                                </p>
                                <a href="{{asset('admin/sitters/detail/delete_feedback/')}}/{{$feed->id}}"><strong style="color: yellowgreen">Xóa</strong></a>
                            </td>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="pull-right">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
