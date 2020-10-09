@extends('layouts.adminLayout.admin_design')
@section('title','Chi tiết phụ huynh')
@section('content')

<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Phụ huynh</a> <a href="#" class="current">Xem chi tiết</a> </div>
      <h1>Chi tiết Phụ huynh</h1>

      @include('noti.errors')
      @include('noti.success')
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon icon-eye-open"></i> </span>
              <h5 >{{$parent->name}}</h5>
            </div>
            <div class="widget-content">
              <div class="row-fluid">
                <div class="span4">
                    <img src="{{asset('uploads/parents_profile/')}}/{{$parent->avatar}}" width="100%">
                </div>
                {{-- <br> --}}
                <div class="span8">
                  <table class="table table-bordered table-invoice">
                    <tbody>
                      <tr>
                        <td class="width30">Họ tên:</td>
                        <td class="width70"><strong>{{$parent->name}}</strong></td>
                      </tr>
                      <tr>
                        <td>Ngày sinh:</td>
                        <td><strong>{{$parent->birthDay}}</strong></td>
                      </tr>
                      <tr>
                        <td class="width30">Quê quán</td>
                         <td class="width70"><strong>{{$parent->address}}</strong> </td>
                      </tr>
                    <tr>
                        <td class="width30">Nơi làm việc</td>
                        <td class="width70">
                            @if(count($location) !=0)
                                <strong>{{$location[0]->address}}</strong>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="width30">Email</td>
                        <td class="width70"><strong>{{$parent->email}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Số điện thoại</td>
                        <td class="width70"><strong>{{$parent->phone}}</strong> </td>
                    </tr>

                    <tr>
                        <td class="width30">Mô tả chi tiết</td>
                        <td class="width70"><strong>{{$parent->description}}</strong> </td>
                    </tr>
                    <tr>
                        <td class="width30">Tham gia vào lúc</td>
                        <td class="width70"><strong>{{$parent->created_at}}</strong> </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <br>
              <h4 id="feedback">Đánh giá từ người dùng bảo mẫu</h4>
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
                                <center><img src="{{asset('uploads/sitters_profile/')}}/{{$feed->avatar}}"width="50%"></center>
                                <center><a href="{{asset('admin/sitters/detail/')}}/{{$feed->id_sitter}}">
                                    <h5>{{$feed->name}}</h5>
                                </a></center>
                            </td>
                            <td>
                                <span>Điểm đánh giá:
                                    @if($feed->rate_parent==1)
                                        <i class="icon icon-star"></i>
                                    @elseif($feed->rate_parent==2)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @elseif($feed->rate_parent==3)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @elseif($feed->rate_parent==4)
                                        <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @else
                                    <i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i>
                                    @endif
                                </span>
                                <p>
                                    {!! $feed->content_parent !!}
                                </p>
                                <a href="{{asset('admin/parents/detail/delete_feedback/')}}/{{$feed->id}}"><strong style="color: yellowgreen">Xóa</strong></a>
                            </td>
                      @endforeach
                      @if(count($feedback)==0)
                        <strong style="color: rebeccapurple">Không có đánh giá nào</strong>
                    @endif
                    </tbody>
                  </table>

                  <h4 id="posts">Bài viết</h4>
                  <div class="row-fluid">
                    <div class="span12">
                        <table class="table table-boredred table-invoice-full">
                            <thead>
                                <tr>
                                    <th class="span4">Tiêu dề</th>
                                    <th class="span6">Nội dung</th>
                                    <th class="span2">Ngày đăng</th>
                                </tr>
                                <tbody>
                                   @foreach($posts as $post)
                                    <tr>
                                       <td>
                                            {{$post->title}} <br>
                                            <a onclick="return confirm('Bạn có chắc chưa?')"
                                            href="{{asset('admin/parents/detail/delete_post')}}/{{$post->id}}" style="color: blueviolet">(Xóa)</a>
                                        </td>
                                        <td>
                                            {!! $post->content !!}
                                            @if($post->images !=null)
                                                <img src="{{asset('uploads/posts/')}}/{{$post->images}}" width="50%">
                                            @endif
                                        </td>
                                        <td>
                                            {{$post->created_at}}
                                        </td>
                                    </tr>
                                   @endforeach
                                   @if(count($posts)==0)
                                        <strong style="color: rebeccapurple"> Không có bài viết nào</strong>
                                    @endif
                                </tbody>
                            </thead>
                        </table>
                    </div>
                  </div>
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
