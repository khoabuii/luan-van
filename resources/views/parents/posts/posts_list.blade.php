@extends('layouts.parentLayout.parent_app')
@section('title','Bài viết')
@section('content')
<!-- Page Heading -->
@if(session('success'))
<script>
    alert('{{session('success')}}');
</script>
@endif
<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bài viết</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li>
                        <button type="button" class="btn btn-primary fa fa-pencil-square-o"
                        data-toggle="modal" data-target=".post_add"> ĐĂNG BÀI VIẾT
                        </button>
                    </li>
                </ul>
        @include('noti.errors')
                 <!-- modal feedback -->
        <div class="modal fade post_add" id="post_add" tabindex="-1" role="dialog" aria-labelledby="post_add" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="post_add">Đăng bài viết mới</h5>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{route('post.add')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                   <div class="form-group">
                        <label for="" class="col-form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name="title">
                   </div>
                   <label for="company_logo">Hình ảnh:</label>
                    <div class="field">
                        <input type="file" class="form-control hidden" name="image" id="img" onchange="changeImg(this)"/>
                        <img id="avatar" class="thumbnail" width="140px" src="{{asset('homepage/images/seo.png')}}">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label" >Nội dung chi tiết:</label>
                      <textarea class="form-control" id="ckeditor" name="description" cols="50"></textarea>
                      <script>CKEDITOR.replace('ckeditor');</script>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Đăng</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- end modal feedback-->
            </div>
        </div>
    </div>
</section>
<!-- Page Heading / End -->

<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-md-8">
                <!-- Post (Standard Format) -->
                @foreach($posts as $post)
                @if($post->parent)
                    <article class="entry entry__standard entry__with-icon">
                        <header class="entry-header">
                            <div class="entry-icon visible-md visible-lg">
                                <img src="{{asset('uploads/parents_profile/')}}/{{$post->parent_avatar}}" alt="" width="140%" height="160%">
                            </div>
                            <a href="{{asset('parent/posts/view/')}}/{{$post->id}}"><h2>{{$post->title}}</h2></a>
                            <div class="entry-meta">
                                <span class="entry-author"><i class="fa fa-user"></i>
                                    @if($post->parent==Auth::guard('parents')->user()->id)
                                        Tôi
                                    @else
                                        <a href="{{asset('parent/parent_profile/')}}/{{$post->parent}}">{{$post->parent_name}}
                                        </a>
                                    @endif
                                </span>
                                <span class="entry-comments"><i class="fa fa-comments"></i>
                                    <a data-toggle="modal" data-target="#comment_{{$post->id}}"> Comments</a></span>
                                <span class=""><i class="fa fa-back-in-time"></i>
                                    @if(date_diff(date_create($post->created_at), date_create('now'))->d==0)
                                        Hôm nay
                                    @else
                                        {{date_diff(date_create($post->created_at), date_create('now'))->d}} ngày trước
                                    @endif
                                </span>
                                <span>
                                    Phụ huynh
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
                    </article>
                @elseif($post->sitter)
                <article class="entry entry__standard entry__with-icon">
                    <header class="entry-header">
                        <div class="entry-icon visible-md visible-lg">
                            <img src="{{asset('uploads/sitters_profile/')}}/{{$post->sitter_avatar}}" alt="" width="140%" height="160%">
                        </div>
                        <a href="{{asset('parent/posts/view/')}}/{{$post->id}}"><h2>{{$post->title}}</h2></a>
                        <div class="entry-meta">
                            <span class="entry-author"><i class="fa fa-user"></i>
                                <a href="{{asset('parent/sitter_profile/')}}/{{$post->sitter}}">{{$post->sitter_name}}
                                </a>
                            </span>
                            <span class="entry-comments"><i class="fa fa-comments"></i> <a data-toggle="modal" data-target="#comment_{{$post->id}}"> Comments</a></span>
                            <span class=""><i class="fa fa-back-in-time"></i>
                                @if(date_diff(date_create($post->created_at), date_create('now'))->d==0)
                                    Hôm nay
                                @else
                                    {{date_diff(date_create($post->created_at), date_create('now'))->d}} ngày trước
                                @endif
                            </span>
                            <span style="color: rgb(32, 122, 59)74, 97, 97)">
                                Bảo mẫu
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
                </article>
                @endif
                @endforeach
                <!-- modal comment -->
                @foreach($posts as $post)
                    <div class="modal fade" id="comment_{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="comments" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <h4>Bình luận bài viết:<span style="color: brown">{{$post->title}}</span> </h4>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <!-- content comments -->
                                    @foreach($comments as $comment)
                                    @if($comment->posts==$post->id)
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    @if(!empty($comment->sitter))
                                                        <h5>{{$comment->sitter_name}} <p style="color: black">(Bảo mẫu)</p></h5>
                                                    @elseif(!empty($comment->parent))
                                                        <h5>{{$comment->parent_name}} <p style="color: black">(Phụ huynh)</p></h5>
                                                    @endif
                                                </div>
                                                <div class="col-md-9">
                                                    <span>{{$comment->content}} </span><br>
                                                    Vào lúc: <i>{{$comment->created_at}}</i>
                                                    @if($comment->parent==Auth::guard('parents')->user()->id)
                                                        &nbsp; <a href="{{asset('parent/posts/delete_comment/'.$comment->id.'')}}">Xóa</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <form action="{{asset('parent/posts/comment/')}}/{{$post->id}}" method="GET">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <textarea name="content" placeholder="Nhập bình luận" cols="70" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <input type="submit" class="btn btn-primary" value="Gửi">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function sendComment({{$post->id}}) {
                            $.ajax({
                                type: 'POST',
                                url: "{{asset('parent/posts/comment/7')}}",
                                success: function(data){
                                    alert(url);
                                    document.getElementsByName("content").value="";
                                }
                            })
                        }
                    </script>
                @endforeach
                <!-- end modal comment -->
                <div class="text-center">
                    {{-- <ul class="pagination-custom list-unstyled list-inline">
                        <li><a href="#" class="btn btn-sm">&laquo;</a></li>
                        <li class="active"><a href="#" class="btn btn-sm">1</a></li>
                        <li><a href="#" class="btn btn-sm">2</a></li>
                        <li><a href="#" class="btn btn-sm">3</a></li>
                        <li><a href="#" class="btn btn-sm">4</a></li>
                        <li><a href="#" class="btn btn-sm">5</a></li>
                        <li><a href="#" class="btn btn-sm">&raquo;</a></li>
                    </ul> --}}
                </div>
            </div>

            <aside class="sidebar col-md-4">

                <hr class="visible-sm visible-xs lg">

                <!-- Widget :: Latest Posts -->
                <div class="latest-posts-widget widget widget__sidebar">
                    <h3 class="widget-title">Bài viết dành cho bạn</h3>
                    <div class="widget-content">
                        <ul class="latest-posts-list">
                            <li>
                                <figure class="thumbnail"><a href="{{asset('posts/what_is_babysitter')}}"><img src="images/samples/post-img-1-sm.jpg" alt=""></a></figure>
                                <span class="date">24/07/2020</span>
                                <h5 class="title"><a href="{{asset('posts/what_is_babysitter')}}">Nghề Babysittter là gì</a></h5>
                            </li>
                            <li>
                                <figure class="thumbnail"><a href="{{asset('posts/what_is_babysitter')}}"><img src="images/samples/post-img-2-sm.jpg" alt=""></a></figure>
                                <span class="date">16/07/2020</span>
                                <h5 class="title"><a href="{{asset('posts/what_is_babysitter')}}">Làm thế nào để tìm được người bảo mẫu tốt?</a></h5>
                            </li>
                            <li>
                                <figure class="thumbnail"><a href="{{asset('posts/what_is_babysitter')}}"><img src="images/samples/post-img-3-sm.jpg" alt=""></a></figure>
                                <span class="date">14/07/2020</span>
                                <h5 class="title"><a href="{{asset('posts/what_is_babysitter')}}">Chăm sóc cho trẻ biến ăn</a></h5>
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
{{-- upload images --}}
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
<!-- Page Content / End -->
@endsection
