@extends('layouts.adminLayout.admin_design')
@section('title','Gửi thông điệp cho Bảo mẫu')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="#">Thông điệp</a>
            <a href="#" class="current">Gửi thông điệp</a>
        </div>
            <h1>Form thông điệp cho Bảo mẫu</h1>
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
                <form action="" method="POST">
                    {{csrf_field()}}
                    <div class="controls">
                        <textarea class="textarea_editor span12" name="content" id="ckeditor" rows="6" placeholder="Enter text ..."></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">
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
