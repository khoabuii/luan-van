@extends('layouts.parentLayout.parent_app')
@section('title','Bảo mẫu đã lưu')
@section('content')
<!-- Page Heading -->
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Danh sách bảo mẫu đã lưu</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="{{asset('parent/')}}">Home</a></li>

                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Page Heading / End -->
@if(session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
        <strong></strong> {{session('success')}}
    </div>
@endif
<!-- Page Content -->
<section class="page-content">
    <div class="container">

        <ul class="team-list row">
            @foreach($save_list as $list)
            <li class="team-item col-md-3">
                <div class="team-item-inner">
                    <figure class="team-thumb">
                        <a href="{{asset('parent/sitter_profile')}}/{{$list->id_sitter}}"><img src="{{asset('uploads/sitters_profile')}}/{{$list->images}}" alt=""></a>
                    </figure>
                    <header class="team-head">
                        <a href="{{asset('parent/sitter_profile')}}/{{$list->id_sitter}}"><h5 class="team-name">{{$list->name}}</h5></a>
                        <span class="team-head-info">BabySitter</span>
                    </header>
                    <div class="team-excerpt">
                        @if(date_diff(date_create($list->updated_at), date_create('now'))->d==0)
                            <span>Thêm vào hôm nay</span>
                        @else
                        <span>Thêm vào {{date_diff(date_create($list->updated_at), date_create('now'))->d}} ngày trước</span><br>
                        @endif
                        <br>
                        <a href="{{asset('parent/save_sitters/delete')}}/{{$list->id}}">Xóa</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
</section>
<!-- Page Content / End -->
@endsection
