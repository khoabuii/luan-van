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
                    <div class="btn-group" id="status">
                            @if($sitter->status==0)
                             <button data-toggle="dropdown">
                               <span id="active" style="color: rgb(97, 97, 31)">Chưa Xác thực</span>
                            @elseif($sitter->status==1)
                            <button data-toggle="dropdown">
                                <span id="un_active" style="color:yellowgreen">Đã xác thực</span>
                            @elseif($sitter->status==2)
                            <button class="btn btn-danger" data-toggle="dropdown">
                                Bị khóa
                            @endif
                        </button>
                        {{-- <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button> --}}
                        <ul class="dropdown-menu">
                          <li><button onclick="return cancel_active_{{$sitter->id}}();">Hủy bỏ xác thực</button></li>
                          <li><button onclick="return active_{{$sitter->id}}();">Xác thực</button></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <a style="color: rgb(77, 44, 197)" href="{{asset('admin/sitters/detail/')}}/{{$sitter->id}}"><i class="icon icon-eye-open"></i> Chi tiết</a><br>
                    / <a style="color:  rgb(77, 44, 197)" href="{{asset('admin/sitters/delete/')}}/{{$sitter->id}}" onclick="return confirm('Bạn chắc chưa?')"><i class="icon icon-remove">
                        </i> Xóa tài khoản</a>
                </td>
            </tr>
            {{-- ajax --}}
            <script>
                function active_{{$sitter->id}}(){
                    $.ajax({
                        type:'GET',
                        url:'{{asset('admin/sitters/active')}}/{{$sitter->id}}',

                        success:function(html){
                            document.getElementById("active").innerHTML="Đã xác thực";
                        },error:function() {
                            console.log(data);
                        }
                    });
                }

                function cancel_active_{{$sitter->id}}(){
                    $.ajax({
                        type:'GET',
                        url:'{{asset('admin/sitters/cancel_active')}}/{{$sitter->id}}',
                        success:function(html){
                            document.getElementById("un_active").innerHTML="Hủy bỏ xác thực";
                        },error:function() {
                            console.log(data);
                        }
                    });
                }
            </script>
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
