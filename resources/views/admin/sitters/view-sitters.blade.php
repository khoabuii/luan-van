@extends('layouts.adminLayout.admin_design')
@section('title','Xem danh sách người bảo mẫu')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#">Bảo mẫu</a> <a href="#" class="current">Xem danh sách bảo mẫu</a> </div>
        <h1>Bảo mẫu</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5>Danh sách các bảo mẫu</h5>
    </div>
    <div class="widget-content nopadding">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Quê quán</th>
            <th>SĐT</th>
            <th>Giới tính</th>
            <th>Trạng thái</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sitters as $sitter)
            <tr class="gradeX">
                <td>
                    {{$sitter->id}}
                </td>
                <td>
                    {{$sitter->name}}
                </td>
                <td>
                    {{$sitter->email}}
                </td>
                <td>
                    {{$sitter->address}}
                </td>
                <td>
                    {{$sitter->phone}}
                </td>
                <td>
                    @if($sitter->gender==0)
                        Nam
                    @else Nữ
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                            @if($sitter->status==0)
                             <button class="btn btn-warning" data-toggle="dropdown">
                               Chưa Xác thực
                            @elseif($sitter->status==1)
                            <button class="btn btn-success" data-toggle="dropdown">
                                Đã xác thực
                            @elseif($sitter->status==2)
                            <button class="btn btn-danger" data-toggle="dropdown">
                                Bị khóa
                            @endif
                        </button>
                        {{-- <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button> --}}
                        <ul class="dropdown-menu">
                          <li><a href="#">Chưa kiểm duyệt</a></li>
                          <li><a href="#">Xác thực</a></li>
                          <li><a href="#">Khóa</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <a style="color: rgb(77, 44, 197)" href="{{asset('admin/sitters/detail/')}}/{{$sitter->id}}"> Xem chi tiết</a><br>
                    / <a style="color:  rgb(77, 44, 197)" href="{{asset('admin/sitters/delete/')}}/{{$sitter->id}}" onclick="return confirm('Bạn chắc chưa?')">Xóa tài khoản</a>
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
