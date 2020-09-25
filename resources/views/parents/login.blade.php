@extends('layouts.parentLayout.parent_app')
@section('title','Login')
@section('content')
<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <h3>Đăng nhập</h3>
                    @include('noti.success')
                    <form action="{{asset('/parent/login')}}" method="POST" role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Email<span class="required">*</span></label>
                            <input type="email" name="email" placeholder="Nhập địa chỉ email" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="clearfix">
                                <label class="pull-left">
                                    Mật khẩu <span class="required">*</span>
                                </label>
                                <span class="pull-right"><a href="#">Quên mật khẩu?</a></span>
                            </div>
                            <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control">
                        </div>
                        @include('noti.errors')
                        <button type="submit" class="btn btn-primary btn-inline">Đăng nhập</button>&nbsp; &nbsp; &nbsp;
                        <label for="remember" class="checkbox-inline">
                            <input type="checkbox" name="remember" id="remember"> Remember me
                        </label>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="spacer-lg visible-sm visible-xs"></div>
                <div class="box">
                    <h3>Đăng ký</h3>
                    <form action="" method="POST" role="form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Họ tên <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ngày sinh <span class="required">*</span></label>
                                    <input type="date" name="birthDay" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Địa chỉ email <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giới tính <span class="required">*</span></label>
                                    <br>
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="true" name="gender" checked> Nam<br>
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="false" name="gender"> Nữ
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Số điện thoại <span class="required">*</span></label>
                                    <input type="number" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Tình độ học vấn</label>
                                    <input type="text" name="education" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Mật khẩu <span class="required">*</span>
                                    </label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Nhập lại mật khẩu <span class="required">*</span>
                                    </label>
                                    <input type="password" name="re-password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tỉnh /Thành phố</label> <br>
                                    <select class="form-control" name="provinces">
                                        <option value="">Chọn Tỉnh/ Thành phố--</option>
                                        @foreach($address as $add)
                                            <option value="{{$add->id}}">{{$add->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Huyện /Quận</label> <br>
                                    <select class="form-control" name="districts">
                                        <option value="">Chọn Huyện /Quận--</option>
                                        @if(!empty($districts))
                                            @foreach($districts as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Xã /Phường</label> <br>
                                    <select class="form-control" name="wards">
                                        <option value="">Chọn Xã /Phường--</option>
                                        @if(!empty($wards))
                                            @foreach($wards as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả chi tiết bản thân</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <span class="required">*</span><small> Những trường này là bắt buộc</small>
                        <br>
                        @include('noti.errors')
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Page Content / End -->

{{-- ajax address --}}
<script type="text/javascript">
    var url_districts = "{{ url('/showDistricts')}}";
    var url_wards = "{{ url('/showWards')}}";
    // show districts
    $("select[name='provinces']").change(function(){
        var province_id = $(this).val();
        // console.log(province_id);
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url_districts,
            method: 'POST',
            data: {
                province_id: province_id,
                _token: token
            },
            success: function(data) {
                $("select[name='districts'").html('');
                $.each(data, function(key, value){
                    $("select[name='districts']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
    //end show district

    // show wards
    $("select[name='districts']").change(function(){
        var district_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url_wards,
            method: 'POST',
            data: {
                district_id: district_id,
                _token: token
            },
            success: function(data) {
                $("select[name='wards'").html('');
                $.each(data, function(key, value){
                    $("select[name='wards']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
</script>
@endsection
