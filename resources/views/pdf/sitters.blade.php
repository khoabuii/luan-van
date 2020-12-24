<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/uniform.css')}}" />
    <title>Danh sách bảo mẫu</title>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <h2>Danh sách các bảo mẫu có trong hệ thống</h2>
    <p> Ngày cập nhật:
        @php
           echo date("d/m/y h:m");
        @endphp
    </p>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Quê quán</th>
            <th>SĐT</th>
            <th>Giới tính</th>
            <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sitters as $sitter)
            <tr class="gradeX">
                <td>
                    {{$sitter->id}}
                </td>
                <td>
                    {{$sitter->name}}
                </td>
                <td>
                    {{$sitter->email}}
                </td>
                <td>
                    {{$sitter->address}}
                </td>
                <td>
                    {{$sitter->phone}}
                </td>
                <td>
                    @if($sitter->gender==0)
                        Nam
                    @else Nữ
                    @endif
                </td>
                <td>
                    <div class="btn-group" id="status">
                        @if($sitter->status==0)
                            <span id="active" style="color: rgb(97, 97, 31)">Chưa Xác thực</span>
                        @elseif($sitter->status==1)
                            <span id="un_active" style="color:yellowgreen">Đã xác thực</span>
                        @elseif($sitter->status==2)
                            Bị khóa
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
