@extends('layouts.parentLayout.parent_app')
@section('title','Bài viết')
@section('content')
<!-- Page Heading -->
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
                        data-toggle="modal" data-target=".post_add">ĐĂNG BÀI VIẾT
                        </button>
                    </li>
                </ul>
                 <!-- modal feedback -->
        <div class="modal fade post_add" id="post_add" tabindex="-1" role="dialog" aria-labelledby="post_add" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="post_add">Đăng bài viết mới</h5>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{route('post.add')}}" method="POST">
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
                <article class="entry entry__standard entry__with-icon">
                    <figure class="alignnone entry-thumb">
                        <a href="#"><img src="{{asset('hompage/images/samples/post-img-1-md.jpg')}}" alt=""></a>
                    </figure>
                    <header class="entry-header">
                        <div class="entry-icon visible-md visible-lg">
                            <img src="https://khoabui.dev/uploads/sitters_profile/RUxKhOO2mFB3byTGhpiciK8oc31jtyijetr3QSTP.jpeg" alt="" width="140%" height="160%">
                        </div>
                        <h2><a href="blog-post.html">Standard Post Format (with Image)</a></h2>
                        <div class="entry-meta">
                            <span class="entry-category"><i class="fa fa-folder"></i> <a href="#">Cat Sitter</a></span>
                            <span class="entry-author"><i class="fa fa-user"></i> <a href="#">Dan Fisher</a></span>
                            <span class="entry-comments"><i class="fa fa-comments"></i> <a href="#">0 Comments</a></span>
                        </div>
                    </header>
                    <div class="excerpt">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu nisi ac mi malesuada vestibulum. Phasellus tempor nunc eleifend cursus molestie. Mauris lectus arcu, pellentesque at sodales sit amet, condimentum id nunc. Donec ornare mattis suscipit. Praesent fermentum accumsan vulputate. Sed velit nulla, sagittis non erat id, dictum vestibulum ligula.
                    </div>
                    <footer class="entry-footer">
                        <a href="#" class="btn btn-primary">Read More</a>
                    </footer>
                </article>

                <div class="text-center">
                    <ul class="pagination-custom list-unstyled list-inline">
                        <li><a href="#" class="btn btn-sm">&laquo;</a></li>
                        <li class="active"><a href="#" class="btn btn-sm">1</a></li>
                        <li><a href="#" class="btn btn-sm">2</a></li>
                        <li><a href="#" class="btn btn-sm">3</a></li>
                        <li><a href="#" class="btn btn-sm">4</a></li>
                        <li><a href="#" class="btn btn-sm">5</a></li>
                        <li><a href="#" class="btn btn-sm">&raquo;</a></li>
                    </ul>
                </div>
            </div>

            <aside class="sidebar col-md-4">

                <hr class="visible-sm visible-xs lg">

                <!-- Widget :: Latest Posts -->
                <div class="latest-posts-widget widget widget__sidebar">
                    <h3 class="widget-title">Gợi ý bảo mẫu cho bạn</h3>
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
