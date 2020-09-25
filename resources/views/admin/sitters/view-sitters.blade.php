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
            <th>Nơi làm việc</th>
            <th>SĐT</th>
            <th>Giới tính</th>
            <th>Trạng thái</th>
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
                    @if($sitter->status==0)
                       <span style="color: rgb(201, 174, 21)">Chưa duyệt</span>
                    @elseif($sitter->status==1)
                        <span style="color: brown">Từ chối/ Khóa</span>
                    @elseif($sitter->status==2)
                        <span style="color: seagreen">Đang hoạt động</span>
                    @endif
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
