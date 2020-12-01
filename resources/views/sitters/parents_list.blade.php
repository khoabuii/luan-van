@extends('layouts.sittersLayout.sitter_app')
@section('title','Danh sách phụ huynh')
@section('content')

    <!-- Page Heading -->
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Danh sách các phụ huynh</h1>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><a href="#">Phụ huynh</a></li>
                        <li class="active">Danh sách phụ huynh</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Heading / End -->
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="job_listings">
            <form class="job_filters" action="{{asset('sitter/search_parent')}}" method="GET">
                <div class="search_jobs">
                    <div class="search_keywords">
                        <label for="search_keywords">Keywords</label>
                        <input type="text" name="name" id="search_keywords" placeholder="All Pet Sitters" class="form-control" value="" />
                    </div>

                    <div class="search_type">
                        <label>Service</label>
                        <span class="select-style">
                            <select class="form-control" name="province">
                                <option value="0">Tất cả địa điểm</option>
                                @foreach($location as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>

                    {{-- <div class="search_location">
                        <label for="search_location">Location</label>
                        <input type="text" name="search_location" id="search_location" placeholder="Any Location" class="form-control" value="" />
                    </div> --}}
                    <div class="search_submit">
                        <button class="btn btn-block btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
<br>
            <ul class="job_listings">
                @foreach($parents as $parent)
                <li class="job_listing" style="font-size: 110%">
                    <a href="{{asset('sitter/parent_profile')}}/{{$parent->id}}">
                        <img src="{{asset('/uploads/parents_profile')}}/{{$parent->img}}" alt="" class="company_logo">
                        <div class="position">
                            <h3>{{$parent->name}}</h3>
                            <div class="company">
                                <strong></strong>
                            </div>
                        </div>
                        <div class="location" style="width:30%">
                            <i class="fa fa-map-marker"></i> {{strstr($parent->address,',')}}
                        </div>
                        <div class="meta">
                            @if(date_diff(date_create($parent->created_at), date_create('now'))->d !=0)
                                <h5>{{date_diff(date_create($parent->created_at), date_create('now'))->d}} ngày trước</h5>
                            @elseif(date_diff(date_create($parent->created_at), date_create('now'))->d==0)
                                <h5>{{date_diff(date_create($parent->created_at), date_create('now'))->h}} giờ trước</h5>
                            @endif
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="spacer"></div>

        <div class="text-center">
            <ul class="pagination-custom list-unstyled list-inline">
                {{$parents->links()}}
            </ul>
        </div>

    </div>
</section>
<!-- Page Content / End -->
@endsection
