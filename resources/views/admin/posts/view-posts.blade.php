@extends('layouts.adminLayout.admin_design')
@section('title','Xem danh sách bài viết')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#">Bài viết</a> <a href="#" class="current">Xem danh sách Bài viết</a> </div>
        <h1>Bài viết</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5>Danh sách các Bài viết bởi người dùng Phụ huynh</h5>
    </div>
    <div class="widget-content nopadding">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="span3">Người đăng</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Ngày đăng</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr class="gradeX">
                <td class="span3">
                    <center>
                    <img src="{{asset('uploads/parents_profile')}}/{{$post->avatar}}" width="50%"><br>
                    <a href="{{asset('admin/parents/detail')}}/{{$post->id_parent}}" style="color: blueviolet">{{$post->name}}</a>
                    </center>
                </td>
                <td>
                    {{$post->title}}
                </td>
                <td>
                    {!!$post->content !!}
                    @if($post->images !=null)
                    <img src="{{asset('uploads/posts')}}/{{$post->images}}" width="40%">
                    @endif
                </td>
                <td>
                    {{$post->created_at}}
                </td>
                <td>
                    <a href="{{asset('admin/posts/detail')}}/{{$post->id}}" style="color: blueviolet">Xem chi tiết</a> /
                    <a href="{{asset('admin/parents/detail/delete_post')}}/{{$post->id}}" style="color: blueviolet" onclick="return confirm('Bạn có chắc chưa?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
            </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
