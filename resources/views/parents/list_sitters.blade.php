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

        <div class="job_listings">
            <form class="job_filters">

                <div class="search_jobs">
                    <div class="search_keywords">
                        <label for="search_keywords">Keywords</label>
                        <input type="text" name="search_keywords" id="search_keywords" placeholder="All Pet Sitters" class="form-control" value="" />
                    </div>

                    <div class="search_type">
                        <label>Service</label>
                        <span class="select-style">
                            <select class="form-control">
                                <option value="0">All Categories</option>
                                <option value="1">Summer Babysitting Jobs</option>
                                <option value="2">Infant Babysitting Jobs</option>
                                <option value="3">Part Time Babysitting Jobs</option>
                                <option value="4">English-Speaking Babysitting Jobs</option>
                                <option value="5">Live-In Babysitting Jobs</option>
                            </select>
                        </span>
                    </div>

                    <div class="search_location">
                        <label for="search_location">Location</label>
                        <input type="text" name="search_location" id="search_location" placeholder="Any Location" class="form-control" value="" />
                    </div>
                    <div class="search_submit">
                        <button class="btn btn-block btn-primary" type="submit">Search</button>
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
                            @if(date_diff(date_create($sitter->created_at), date_create('now'))->d !=0)
                                <h5>{{date_diff(date_create($sitter->created_at), date_create('now'))->d}} ngày trước</h5>
                            @elseif(date_diff(date_create($sitter->created_at), date_create('now'))->d==0)
                                <h5>{{date_diff(date_create($sitter->created_at), date_create('now'))->h}} giờ trước</h5>
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
                {{$sitters->links()}}
            </ul>
        </div>

    </div>
</section>
<!-- Page Content / End -->
@endsection