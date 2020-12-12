@extends('layouts.sittersLayout.sitter_design')
@section('content')
@if(Session::has('success'))
<script>
    alert('{{session('success')}}');
</script>
@endif
<section class="page-content">
    <div class="container">
        <form action="{{asset('sitter/search_parent')}}" method="GET">
            <center><h2>Bạn muốn tìm Phụ huynh ở đâu?</h2>
            <div class="row">
                <div class="col-md-8">
                    <select class="form-control" name="province" style="color: rgb(10, 128, 128)">
                        <option value="0">Tất cả đại điểm</option>
                        @foreach($location as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-block btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </div>
            </center>
        </form>
        <br>
        <div class="row">
            <div class="col-md-4">
                <!-- Icon Box -->
                <div class="icon-box boxed circled icon-box-color__primary">
                    <div class="icon-box-body">
                        <h2>Kết nối không giới hạn</h2>
                        Chúng tôi cung cấp giải pháp giúp mọi người dễ dàng liên hệ với nhau
                    </div>
                </div>
                <!-- Icon Box / End -->
            </div>
            <div class="col-md-4">
                <!-- Icon Box -->
                <div class="icon-box boxed circled icon-box-color__secondary">
                    <div class="icon-box-body">
                        <h2>Kết nối thông minh</h2>
                        Chúng tôi sử dụng những công nghệ hiện đại nhất để giải quyết những vấn đề cho khách hàng
                    </div>
                </div>
                <!-- Icon Box / End -->
            </div>
            <div class="col-md-4">
                <!-- Icon Box -->
                <div class="icon-box boxed circled icon-box-color__tertiary">
                    <div class="icon-box-body">
                            <h2>Bảo vệ thông tin khách hàng</h2>
                            Chúng tôi đảm bảo thông tin của anh chị luôn được bảo mật.
                    </div>
                </div>
                <!-- Icon Box / End -->
            </div>
        </div>
        <div class="spacer-lg"></div>
        @Auth
        <h2>Phụ huynh gần bạn</h2>
        <div class="row">
        @if(count($your_province)!=0)
            @foreach($parent_near as $parent)
            <div class="col-xs-6 col-sm-3 col-md-3" data-animation="fadeInLeft" data-animation-delay="0">
                <div class="job-listing-box">
                    <figure class="job-listing-img">
                        <a href="{{asset('sitter/parent_profile')}}/{{$parent->id}}"><img src="{{asset('uploads/parents_profile')}}/{{$parent->img}}" alt=""></a>
                    </figure>
                    <div class="job-listing-body">
                        <div class="name"><a href="{{asset('sitter/parent_profile')}}/{{$parent->id}}">{{$parent->name}}</a></div>
                        <p>{{$parent->description}}</p>
                    </div>
                    <footer class="job-listing-footer">
                        <ul class="meta">
                            <li class="category">Phụ huynh</li>
                            <li class="location"><a href="#">{{$location_name[0]->name}}</a></li>
                            <li class="date">Tham gia vào <span style="color: blue">{{date_diff(date_create($parent->created_at), date_create('now'))->d}}</span> ngày trước</li>
                        </ul>
                    </footer>
                </div>
            </div>
            @endforeach
        @endif
            <div class="clearfix visible-xs"></div>
            <div class="spacer visible-xs"></div>
        </div>
        @endAuth
        <div class="spacer-xl"></div>

        <div class="row">
            <div class="col-md-4">
                <h2>Về chúng tôi</h2>
                <p class="lead">Đây là luận văn về web học kì 2 năm học 2020-2021</p>
                <p>Hãy sử dụng website của chúng tôi,</p>
                <p>Website mang lại trãi nghiệm tốt nhất dành cho bạn giúp bạn kiếm được những thứ mà bạn cần</p>
                <a href="#" class="btn btn-primary">Đọc thêm</a>
            </div>
            <div class="col-md-4">
                <h2>Dịch vụ của chúng tôi</h2>
                <p>Chúng tôi luôn mang lại những trãi nghiệm tốt nhất dành cho khách hàng. </p>
                <div class="list">
                    <ul>
                        <li>Babbysitter</li>
                        <li>Parents</li>
                    </ul>
                </div>
                <a href="#" class="btn btn-primary">Xem tất cả dịch vụ</a>
            </div>
            <div class="col-md-4">
                <h2>Lời khuyên của chúng tôi</h2>
                <ul class="latest-posts-list">
                    <li>
                        <figure class="thumbnail"><a href="{{asset('posts/what_is_babysitter')}}"><img src="{{asset('homepage/images/samples/post-img-1-sm.jpg')}}" alt=""></a></figure>
                        <span class="date">24/07/2020</span>
                        <h5 class="title"><a href="{{asset('posts/what_is_babysitter')}}">Tìm babysitter như thế nào cho hiệu quả nhất</a></h5>
                    </li>
                    <li>
                        <figure class="thumbnail"><a href="{{asset('posts/what_is_babysitter')}}"><img src="{{asset('homepage/images/samples/post-img-2-sm.jpg')}}" alt=""></a></figure>
                        <span class="date">16/07/2020</span>
                        <h5 class="title"><a href="{{asset('posts/what_is_babysitter')}}">Trẻ biến ăn thì giải quyết thế nào.</a></h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
