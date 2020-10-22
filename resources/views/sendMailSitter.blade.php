<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

    <h3><b>Bạn vừa nhận được lời mời làm từ phụ huynh: {{$parent_name}}</b></h3>
<br>
        <div class="form-group">
            <label for="">Tên Phụ huynh: </label>{{$parent_name}}
        </div>
        <div class="form-group">
            <label for="">Mã người dùng: </label>{{$parent_id}}
        </div>
        <div class="form-group">
            <label for="">Tiền thù lao: </label>{{number_format($money)}} VND/ Buổi
        </div>
       <br>
    <legend class="text-left">Nội dung kí kết</legend>
        <p>
            {{$description}}
        </p>
    <span style="color: rgb(72, 72, 177)65, 65, 85)"><i>Bạn hãy truy cập vào
        <a href="{{asset('sitter/contract')}}">link này</a> để Chấp thuận hoặc từ chối yêu cầu làm việc trên nhé</i>
    </span>
</body>
</html>
