<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách phụ huynh</title>
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/admin/css/uniform.css')}}" />
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h2>Danh sách các Phụ huynh</h2>
        </div>
        <p>
            @php
                echo date('d/m/y h:m:s');
            @endphp
        </p>
        <div class="widget-content nopadding">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Nơi ở hiện tại</th>
                <th>SĐT</th>
                <th>Ngày tham gia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parents as $parent)
                <tr class="gradeX">
                    <td>
                        {{$parent->id}}
                    </td>
                    <td>
                        {{$parent->name}}
                    </td>
                    <td>
                        {{$parent->email}}
                    </td>
                    <td>
                        {{$parent->add_current}}
                    </td>
                    <td>
                        {{$parent->phone}}
                    </td>
                    <td>
                        {{$parent->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
