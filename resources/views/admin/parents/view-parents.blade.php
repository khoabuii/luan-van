@extends('layouts.adminLayout.admin_design')
@section('title','Xem danh sách người phụ huynh')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#">Phụ huynh</a> <a href="#" class="current">Xem danh sách Phụ huynh</a> </div>
        <h1>Phụ huynh</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5>Danh sách các Phụ huynh</h5>
    </div>
    <div class="widget-content nopadding">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Nơi ở hiện tại</th>
            <th>SĐT</th>
            <th>Ngày tham gia</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parents as $parent)
            <tr class="gradeX">
                <td>
                    {{$parent->id}}
                </td>
                <td>
                    {{$parent->name}}
                </td>
                <td>
                    {{$parent->email}}
                </td>
                <td>
                    {{$parent->add_current}}
                </td>
                <td>
                    {{$parent->phone}}
                </td>
                <td>
                    {{$parent->created_at}}
                </td>
                <td>
                    <a href="{{asset('admin/parents/detail')}}/{{$parent->id}}" style="color: blueviolet">Xem chi tiết</a> /
                    <a href="{{asset('admin/parents/delete_parent')}}/{{$parent->id}}" style="color: blueviolet" onclick="return confirm('Bạn có chắc chưa?')">Xóa</a>
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
