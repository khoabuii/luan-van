<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách bài viết</title>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h2>Danh sách các Bài viết bởi người dùng Phụ huynh và Bảo mẫu</h2>
        </div>
        <p>Cập nhật vào:
            @php
                echo date('d/m/y h:m:i');
            @endphp
        </p>
        <div class="widget-content nopadding">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th class="span3">Người đăng</th>
                    <th class="span4">Tiêu đề</th>
                    <th>Nội dung</th>
                    <th class="span2">Ngày đăng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr class="gradeX">
                    <td class="span3">
                        @if($post->parent !=null)
                            <center>
                                <a href="{{asset('admin/parents/detail')}}/{{$post->parent}}" style="color: blueviolet">{{$post->parent_name}}</a>(Phụ huynh)
                            </center>
                        @elseif($post->sitter !=null)
                            <center>
                                <a href="{{asset('admin/sitters/detail')}}/{{$post->sitter}}" style="color: blueviolet">{{$post->sitter_name}}</a>(Bảo mẫu)
                            </center>
                        @endif
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        {!!$post->content !!}
                        @if($post->images !=null)
                        <img src="{{asset('uploads/posts')}}/{{$post->images}}" width="40%">
                        @endif
                    </td>
                    <td>
                        {{$post->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
                </table>
        </div>
</body>
</html>
