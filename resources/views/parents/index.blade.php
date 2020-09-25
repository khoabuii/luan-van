@extends('layouts.parentLayout.parent_design')
@section('content')
<section class="page-content">
    <div class="container">

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


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- Call to Action -->
                <div class="call-to-action call-to-action__no-bg centered">
                    <div class="cta-txt">
                        <h1>Chào mừng bạn đã đến website của chúng tôi!</h1>
                        <p>Chúng tôi hy vọng sẽ mang lại trãi nghiệm tốt nhất cho bạn. Hãy đăng ký tham gia vào hệ thống của chúng tôi nhé! </p>
                    </div>
                    <div class="col-md-6">
                                <div class="cta-btn">
                                    <a href="#" class="btn btn-primary btn-lg">Tham gia với vai trò là Phụ huynh</a>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="cta-btn">
                                <a href="#" class="btn btn-tertiary btn-lg">Tham gia với vai trò là Babysitter</a>
                            </div>
                    </div>

                </div>
                <!-- Call to Action / End -->
            </div>
        </div>

        <div class="spacer-lg"></div>
        <h2>Latest Babysitters</h2>
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-3" data-animation="fadeInLeft" data-animation-delay="0">
                <div class="job-listing-box">
                    <figure class="job-listing-img">
                        <a href="job-profile.html"><img src="{{asset('homepage/images/samples/bsitter-1.jpg')}}" alt=""></a>
                    </figure>
                    <div class="job-listing-body">
                        <div class="name"><a href="job-profile.html">Elizabeth G.</a></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <footer class="job-listing-footer">
                        <ul class="meta">
                            <li class="category">Babysitter</li>
                            <li class="location"><a href="#">Orlando, FL</a></li>
                            <li class="date">Posted 1 day ago</li>
                        </ul>
                    </footer>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3" data-animation="fadeInLeft" data-animation-delay="200">
                <div class="job-listing-box">
                    <figure class="job-listing-img">
                        <a href="job-profile.html"><img src="images/samples/bsitter-2.jpg" alt=""></a>
                    </figure>
                    <div class="job-listing-body">
                        <div class="name"><a href="job-profile.html">Hannah S.</a></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <footer class="job-listing-footer">
                        <ul class="meta">
                            <li class="category">Nanny</li>
                            <li class="location"><a href="#">Orlando, FL</a></li>
                            <li class="date">Posted 2 days ago</li>
                        </ul>
                    </footer>
                </div>
            </div>

            <div class="clearfix visible-xs"></div>
            <div class="spacer visible-xs"></div>

            <div class="col-xs-6 col-sm-3 col-md-3" data-animation="fadeInLeft" data-animation-delay="400">
                <div class="job-listing-box">
                    <figure class="job-listing-img">
                        <a href="job-profile.html"><img src="images/samples/bsitter-3.jpg" alt=""></a>
                    </figure>
                    <div class="job-listing-body">
                        <div class="name"><a href="job-profile.html">Jessica N.</a></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <footer class="job-listing-footer">
                        <ul class="meta">
                            <li class="category">Nanny</li>
                            <li class="location"><a href="#">Orlando, FL</a></li>
                            <li class="date">Posted 3 days ago</li>
                        </ul>
                    </footer>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3" data-animation="fadeInLeft" data-animation-delay="600">
                <div class="job-listing-box">
                    <figure class="job-listing-img">
                        <a href="job-profile.html"><img src="images/samples/bsitter-4.jpg" alt=""></a>
                    </figure>
                    <div class="job-listing-body">
                        <div class="name"><a href="job-profile.html">Stephanie F.</a></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <footer class="job-listing-footer">
                        <ul class="meta">
                            <li class="category">Babysitter</li>
                            <li class="location"><a href="#">Orlando, FL</a></li>
                            <li class="date">Posted 5 days ago</li>
                        </ul>
                    </footer>
                </div>
            </div>
        </div>

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
                        <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-1-sm.jpg" alt=""></a></figure>
                        <span class="date">24/07/2020</span>
                        <h5 class="title"><a href="#">Tìm babysitter như thế nào cho hiệu quả nhất</a></h5>
                    </li>
                    <li>
                        <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-2-sm.jpg" alt=""></a></figure>
                        <span class="date">16/07/2020</span>
                        <h5 class="title"><a href="#">Trẻ biến ăn thì giải quyết thế nào.</a></h5>
                    </li>
                    <li>
                        <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-3-sm.jpg" alt=""></a></figure>
                        <span class="date">14/07/2020</span>
                        <h5 class="title"><a href="#">Các tiêu chí chọn sửa cho bé</a></h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
