@extends('layouts.parentLayout.parent_app')
@section('title','Danh sách bảo mẫu')
@section('content')
    <!-- Page Heading -->
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Babysitters</h1>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Babysitters</a></li>
                        <li class="active">Babysitters List</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Heading / End -->
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <form class="job_filters" action="{{asset('parent/search_sitter')}}" method="GET">
            <div style="padding: 2pc">
                <div class="row">
                    <div class="col-md-5">
                        <div class="col-md-5">
                            <input type="text" name="name" id="search_keywords" placeholder="Tên bảo mẫu" class="form-control" value="" />
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="province">
                                <option value="">Tất cả đại điểm</option>
                                @foreach($location as $location)
                                    <option
                                    value="{{$location->id}}"
                                    @if(Request::route('search.sitter'))
                                        @if($province==$location->id)
                                            selected
                                        @endif
                                    @endif
                                        >{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="col-md-3">
                                
                                <select name="status" id="status" class="form-control">
                                    <option value="">Trạng thái</option>
                                    <option value="0">Chưa xác thực</option>
                                    <option value="1">Đã xác thực</option>
                                </select>
                                {{-- <label for="status" class="form-label">Xác thực</label> --}}
                            </div>
                            <div class="col-md-3">
                                <select name="gender" id="" class="form-control">
                                    <option value="">Giới tính</option>
                                    <option
                                    @if(Request::route('search.sitter'))
                                        @if($gender==0)
                                            selected
                                        @endif
                                    @endif
                                            value="0">Nam</option>
                                    <option
                                    @if(Request::route('search.sitter'))
                                        @if($gender==1)
                                            selected
                                        @endif
                                    @endif
                                    value="1">Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-block btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>

                 </div>
            </div>
        </form>
<br>
            <ul class="job_listings">
                @foreach($sitters as $sitter)
                <li class="job_listing" style="font-size: 110%">
                    <a href="{{asset('parent/sitter_profile')}}/{{$sitter->id}}">
                        <img src="{{asset('/uploads/sitters_profile')}}/{{$sitter->img}}" alt="" class="company_logo">
                        <div class="position">
                            <h3>{{$sitter->name}} @if($sitter->status==1)<i class="fa fa-check" style="color: green"></i> @endif</h3>
                            <div class="company">
                                <strong>{{date_diff(date_create($sitter->birthDay), date_create('now'))->y}}</strong> Tuổi
                            </div>
                        </div>
                        <div class="location" style="width:30%">
                            <i class="fa fa-map-marker"></i> {{strstr($sitter->address,',')}}
                        </div>
                        <div class="meta">
                            @php
                                $date_create=$sitter->created_at;
                                $date=new DateTime($date_create);
                                $now=new DateTime();
                            @endphp

                            @if(date_diff(date_create($sitter->created_at), date_create('now'))->d !=0)
                                <h5>{{$date->diff($now)->format("%m tháng, %d ngày trước" )}} </h5>
                            @elseif(date_diff(date_create($sitter->created_at), date_create('now'))->d==0)
                                <h5>Hôm nay</h5>
                            @endif
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        <div class="spacer"></div>

        <div class="text-center">
            <ul class="pagination-custom list-unstyled list-inline">
                {{$sitters->links()}}
            </ul>
        </div>
    </div>
</section>
<!-- Page Content / End -->
@endsection
