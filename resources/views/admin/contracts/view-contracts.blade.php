@extends('layouts.adminLayout.admin_design')
@section('title','Xem danh sách hợp đồng')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#">Hợp đồng</a> <a href="#" class="current">Xem danh sách Hợp đồng</a> </div>
        <h1>Hợp đồng</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5>Danh sách các Hợp đồng làm việc</h5>
    <button class="btn btn-primary">
        <a href="{{url('admin/contracts/pdf')}}">
            Xuất file PDF
        </a>
    </button>
    </div>
    <div class="widget-content nopadding">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="span3">Phụ huynh</th>
                <th class="span3">Bảo mẫu</th>
                <th>Giá tiền</th>
                <th class="span5">Nội dung chi tiết</th>
                <th>Ngày ký kết</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
            <tr class="gradeX">
                <td class="span3">
                    <center>
                    <img src="{{asset('uploads/parents_profile')}}/{{$contract->avatar_parent}}" width="50%"><br>
                    <a href="{{asset('admin/parents/detail')}}/{{$contract->id_parent}}" style="color: blueviolet">{{$contract->name_parent}}</a>
                    @if($contract->check==0)
                        (Người gửi)
                    @endif
                    </center>
                </td>
                <td class="span3">
                    <center>
                    <img src="{{asset('uploads/sitters_profile')}}/{{$contract->avatar_sitter}}" width="50%"><br>
                    <a href="{{asset('admin/sitters/detail')}}/{{$contract->id_sitter}}" style="color: blueviolet">{{$contract->name_sitter}}</a>
                    @if($contract->check==1)
                        (Người gửi)
                    @endif
                    </center>
                </td>
                <td>
                    {{number_format($contract->money)}} VND/Buổi
                </td>
                <td>
                    {!! $contract->description !!}
                </td>
                <td>
                    {{$contract->created_at}}
                </td>
                <td>
                    @if($contract->status==0)
                        Chưa xác nhận
                    @elseif($contract->status==1)
                        Đã xác nhận
                    @endif
                </td>
                <td>
                    <a href="{{asset('admin/contracts/detail')}}/{{$contract->id}}" style="color: blueviolet">
                        <i class="icon icon-eye-open"></i>Xem chi tiết</a> /
                    <a href="{{asset('admin/contracts/delete_contract')}}/{{$contract->id}}" style="color: blueviolet" onclick="return confirm('Bạn có chắc chưa?')">
                        <i class="icon icon-remove"></i>Xóa</a>
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
