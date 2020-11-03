@extends('layouts.adminLayout.admin_design')
@section('title','Gửi thông điệp cho Phụ huynh')
@section('content')

@if(session('success'))
<script>
    alert('{{session('success')}}');
</script>
@endif

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="#">Thông điệp</a>
            <a href="#" class="current">Gửi thông điệp</a>
        </div>
            <h1>Form thông điệp cho Phụ huynh</h1>
        @include('noti.errors')
        @include('noti.success')
    </div>
    <div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nội dung thông điệp</h5>
          </div>
          <div class="widget-content">
            <div class="control-group">
                <form action="{{asset('admin/message/parents')}}" method="POST">
                    {{csrf_field()}}
                    <div class="controls">
                        <label for="">Tiêu đề</label>
                        <input class="span10" type="text" name="subject">
                    </div>
                    <div class="controls">
                        <textarea class="textarea_editor span12" name="content" id="ckeditor" rows="6" placeholder="Enter text ..."></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" onclick="return confirm('Bạn chắc chắn chưa?');">
                        Gửi thông điệp
                    </button>
                </form>
              <script>
                CKEDITOR.replace('ckeditor');
            </script>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
