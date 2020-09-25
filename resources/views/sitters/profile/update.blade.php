@extends('layouts.sittersLayout.sitter_app')
@section('title','Update Profile')
@section('content')
<!-- Page Heading -->
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Cập nhật thông tin tài khoản</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li class="active">Cập nhật</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Page Heading / End -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Job Form -->
                <form action="#" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset>
                        <label>Your Email</label>
                        <div class="field">
                            <input type="email" class="form-control" disabled  value="{{Auth::user()->email}}" />
                        </div>
                    </fieldset>

                    <!-- Job Information Fields -->
                    <fieldset>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="job_title">Họ tên</label>
                                <div class="field">
                                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="job_title">Ngày sinh</label>
                                <div class="field">
                                    <input type="date" class="form-control" name="birthDay" value="{{Auth::user()->birthDay}}"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Giới tính</label>
                                <div class="field">
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="0" name="gender" checked> Nam<br>
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="1" name="gender"> Nữ
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="fieldset-job_location">
                        <label for="job_location">Học vấn <small>(optional)</small></label>
                        <div class="field">
                            <input type="text" value="{{Auth::user()->education}}" class="form-control" name="education" />
                        </div>
                    </fieldset>
                    <fieldset class="fieldset-job_location">
                        <label for="job_location">Quê quán</label>
                        <div class="field">
                            <input type="text" value="{{Auth::user()->address}}" class="form-control" name="address" />
                        </div>
                    </fieldset>

                    <div class="row">
                        <div class="col-md-4">
                            <fieldset class="fieldset-job_type">
                                <label for="job_type">Mật khẩu cũ</label>
                                <div class="field">
                                    <input type="password" name="old-password" class="form-control" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="fieldset-job_type">
                                <label for="job_type">Mật khẩu mới</label>
                                <div class="field">
                                    <input type="password" name="new-password" class="form-control" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="fieldset-job_type">
                                <label for="job_type">Xác nhận Mật khẩu mới</label>
                                <div class="field">
                                    <input type="password" name="re-new-password" class="form-control" />
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <fieldset class="fieldset-job_description">
                        <label>Description</label>
                        <div class="field">
                            <textarea name="description" cols="30" rows="10" id="" class="form-control">{{Auth::user()->description}}
                            </textarea>
                        </div>
                    </fieldset>

                    <fieldset class="fieldset-company_logo">
                        <label for="company_logo">Photo <small>(optional)</small></label>
                        <div class="field">
                            <input type="file" class="form-control hidden" name="images[]" id="img" onchange="changeImg(this)"/>
                            <img id="avatar" class="thumbnail" width="200px" src="{{asset('homepage/images/seo.png')}}">
                        </div>
                    </fieldset>

                    <div class="spacer"></div>

                    <p>
                        <input type="submit" class="btn btn-primary" value="Cập nhật hồ sơ &rarr;" />
                    </p>

                </form>
                <!-- Job Form / End -->
            </div>
        </div>

    </div>
</section>
<script>
    function changeImg(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#avatar').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#avatar').click(function(){
            $('#img').click();
        });
    });
</script>
@endsection
