@extends('layouts.sittersLayout.sitter_app')
@section('title','Bài viết')
@section('content')
<!-- Page Heading -->
@if(session('success'))
<script>
    alert('{{session('success')}}')
</script>
@endif
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bài viết đã lưu</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li>
                    </li>
                </ul>
        @include('noti.errors')
    </div>
</section>
<!-- Page Heading / End -->

<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-md-8">
                <!-- Post (Standard Format) -->
                @foreach($save_list as $post)
                <article class="entry entry__standard entry__with-icon">
                    <header class="entry-header">
                        <div class="entry-icon visible-md visible-lg">
                            <img src="{{asset('uploads/parents_profile/')}}/{{$post->avatar}}" alt="" width="140%" height="160%">
                        </div>
                        <a href="{{asset('sitter/posts/view/')}}/{{$post->id_post}}"><h2>{{$post->title}}</h2></a>
                        <div class="entry-meta">
                            <span class="entry-author"><i class="fa fa-user"></i>
                                <a href="{{asset('sitter/parent_profile/')}}/{{$post->id_parent}}">{{$post->parent_name}}
                                </a>
                            </span>
                            <span class="entry-comments"><i class="fa fa-comments"></i> <a href="#">0 Comments</a></span>
                            <span class=""><i class="fa fa-back-in-time"></i>
                                @if(date_diff(date_create($post->created_at), date_create('now'))->d==0)
                                    Hôm nay
                                @else
                                    {{date_diff(date_create($post->created_at), date_create('now'))->d}} ngày trước
                                @endif
                            </span>
                        </div>
                    </header>
                    <div class="excerpt">
                        {!!$post->content !!}
                        @if($post->images !=null)
                            <figure class="alignnone entry-thumb">
                                <img src="{{asset('uploads/posts/')}}/{{$post->images}}" width="50%" alt="">
                            </figure>
                        @endif
                    </div>
                    <footer class="entry-footer">
                        <a href="{{asset('sitter/posts/save_delete')}}/{{$post->id_save_post}}" class="btn btn-primary">Xóa</a>
                    </footer>
                </article>
                @endforeach
                <div class="text-center">
                    <ul class="pagination-custom list-unstyled list-inline">
                        {{$save_list->links()}}
                    </ul>
                </div>
            </div>

            <aside class="sidebar col-md-4">

                <hr class="visible-sm visible-xs lg">
                <!-- Widget :: Latest Posts -->
                <div class="latest-posts-widget widget widget__sidebar">
                    <h3 class="widget-title">Gợi ý Phụ huynh cho bạn</h3>
                    <div class="widget-content">
                        <ul class="latest-posts-list">
                            <li>
                                <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-1-sm.jpg" alt=""></a></figure>
                                <span class="date">24/07/2013</span>
                                <h5 class="title"><a href="#">Duis placerat rhoncus arcu, sit amet aliquam leo</a></h5>
                            </li>
                            <li>
                                <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-2-sm.jpg" alt=""></a></figure>
                                <span class="date">16/07/2013</span>
                                <h5 class="title"><a href="#">Mauris in arcu aliq, elementum nibh nec</a></h5>
                            </li>
                            <li>
                                <figure class="thumbnail"><a href="#"><img src="images/samples/post-img-3-sm.jpg" alt=""></a></figure>
                                <span class="date">14/07/2013</span>
                                <h5 class="title"><a href="#">Vestibulum in ligula rutrum faucibus interdum</a></h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Widget :: Latest Posts -->

                <!-- Widget :: Tags Cloud -->
                <div class="widget_tag_cloud widget widget__sidebar">
                    <h3 class="widget-title">Tags</h3>
                    <div class="widget-content">
                        <div class="tagcloud">
                            <a href="#" class="btn btn-secondary btn-sm">Babysitting</a>
                            <a href="#" class="btn btn-secondary btn-sm">Babysitting Jobs</a>
                            <a href="#" class="btn btn-secondary btn-sm">Nannies</a>
                            <a href="#" class="btn btn-secondary btn-sm">Tutoring</a>
                            <a href="#" class="btn btn-secondary btn-sm">Tutors</a>
                            <a href="#" class="btn btn-secondary btn-sm">Child Care Jobs</a>
                            <a href="#" class="btn btn-secondary btn-sm">Nanny Jobs</a>
                            <a href="#" class="btn btn-secondary btn-sm">Child Care</a>
                        </div>
                    </div>
                </div>
                <!-- /Widget :: Tags Cloud -->

                <!-- Widget :: Text Widget -->
                <div class="widget_text widget widget__sidebar">
                    <h3 class="widget-title">Lời khuyên của chúng tôi</h3>
                    <div class="widget-content">
                        Hãy cân nhắc lựa chọn kỹ càng người phù hợp nhất cho con của bạn. Chúng tôi sẽ không chịu trách nhiệm những gì đã diễn ra.
                    </div>
                </div>
                <!-- /Widget :: Text Widget -->
            </aside>
        </div>
    </div>
</section>
@endsection
