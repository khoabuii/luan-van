<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contract</title>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <div class="modal-body">
        <h5 class="modal-header">
            Nội dung chi tiết
        </h5>
        <div style="background-color:rgb(220, 236, 236)">
            <p>{{$contract->description}}</p>
        </div>
        <h5 class="modal-header">
            Trạng thái: @if($contract->status==0)
                            <span style="color: greenyellow">Chưa xác nhận</span>
                        @elseif($contract->status==1)
                            <span style="color: green">Đã xác nhận</span>
                        @elseif($contract->status==2)
                            <span style="color: brown">Đã hủy hợp đồng</span>
                        @endif
            @if($contract->check==0 && ($contract->status==0 || $contract->status==1))
                <ul class="job-dashboard-actions">
                    <li><button onclick="return action_{{$contract->id}}();">Xác nhận</button></li>
                    <li><button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button></li>
                </ul>
            @elseif($contract->check==1 && $contract->status==0)
            <ul>
                <li style="display: inline;">
                    <button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button>
                </li>
            </ul>
            @endif
        </h5>
        <p>
            @if($contract->check==1)
                Bạn là người gửi thông tin yêu cầu làm việc.
            @elseif($contract->check==0)
                Bảo mẫu là người gửi thông tin làm việc.
            @endif
        </p>
        <div class="row">
            <div class="col-md-6">
                <h5 class="modal-header">
                    Thời gian gửi: <span style="color: blue">
                        {{$contract->created_at}}
                    </span>
                </h5>
            </div>
            <div class="col-md-6">
                <h5 class="modal-header">
                    Thời gian cập nhật trạng thái: <span style="color: blue">
                        {{$contract->updated_at}}
                    </span>

                </h5>
            </div>
        </div>
    </div>
</body>
</html>
