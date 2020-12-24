<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách hợp đồng</title>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <div class="widget-content nopadding">
        <h2>Danh sách các hợp đồng</h2>
        <p> Cập nhật vào:
            @php
                echo date("d/m/y h:m:i");
            @endphp
        </p>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th class="span3">Phụ huynh</th>
                    <th class="span3">Bảo mẫu</th>
                    <th>Giá tiền</th>
                    <th class="span5">Nội dung chi tiết</th>
                    <th>Ngày ký kết</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                <tr class="gradeX">
                    <td class="span3">
                        <center>
                        <a href="{{asset('admin/parents/detail')}}/{{$contract->id_parent}}" style="color: blueviolet">{{$contract->name_parent}}</a>
                        @if($contract->check==0)
                            (Người gửi)
                        @endif
                        </center>
                    </td>
                    <td class="span3">
                        <center>
                        <a href="{{asset('admin/sitters/detail')}}/{{$contract->id_sitter}}" style="color: blueviolet">{{$contract->name_sitter}}</a>
                        @if($contract->check==1)
                            (Người gửi)
                        @endif
                        </center>
                    <td>
                        {{number_format($contract->money)}} VND/Buổi
                    </td>
                    <td>
                        {!! $contract->description !!}
                    </td>
                    <td>
                        {{$contract->created_at}}
                    </td>
                    <td>
                        @if($contract->status==0)
                            Chưa xác nhận
                        @elseif($contract->status==1)
                            Đã xác nhận
                        @endif
                    </td>
                </tr>
                <hr>
                <br>
                @endforeach
            </tbody>
                </table>
        </div>
</body>
</html>
