@extends('layouts.adminLayout.admin_design')
@section('title','Quản lý kỷ năng')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="#">Bảo mẫu</a>
            <a href="#" class="current">Skills</a>
        </div>
            <h1>Quản lý kỉ năng</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-content">
            <div class="row-fluid">
                <div class="span5">
                    <form action="{{asset('admin/sitters/skill/add')}}" method="POST">
                        {{csrf_field()}}
                        <div>
                            <label for="">Tên kỷ năng</label>
                            <input type="text" name="name" required>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Thêm
                        </button>
                    </form>
                </div>
                <div class="span5">
                    <h5>
                        Danh sách các kỉ năng
                    </h5>
                    <table class="table table-bordered table-invoice">
                        <tbody>
                            @foreach($skills as $skill)
                            <tr>
                                <td>{{$skill->name}}</td>
                                <td width="20%">
                                    <a href="{{asset('admin/sitters/skill/delete/')}}/{{$skill->id}}">
                                        <i class="icon icon-remove-sign"> Xóa</i>
                                    </a>
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
    </div>
</div>
@stop
