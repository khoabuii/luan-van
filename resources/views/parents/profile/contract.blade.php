@extends('layouts.parentLayout.parent_app')
@section('title','Danh sách hợp đồng')
@section('content')

<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <h4>Danh sách hợp đồng</h4>
        <div id="job-manager-job-dashboard">
            <div class="table-responsive">
                <table class="job-manager-jobs table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Hợp đồng</th>
                            <th class="expires" width="18%">Bảo mẫu</th>
                            <th class="date">Thời gian gửi</th>
                            <th class="status" width=20%>Trạng thái</th>
                            <th class="expires" width="45%">Nội dung chi tiết</th>
                            <th class="filled" width="15%">Tiền thù lao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $contract)
                        <tr>
                            <td>
                                {{$contract->id}}
                            </td>
                            <td class="job_title">
                                <center>
                                    <a href="{{asset('parent/sitter_profile')}}/{{$contract->sitter}}" class="job_title_link">{{$contract->sitter_name}}</a>
                                    @if($contract->check==1)(Người gửi yêu cầu)@endif
                                    <br>
                                    <img src="{{asset('uploads/sitters_profile')}}/{{$contract->sitter_img}}" width="50%">
                                </center>
                            </td>
                            <td class="date">{{$contract->created_at}}</td>
                            <td class="status">
                                <p id="confirm{{$contract->id}}"
                                    @if($contract->status==0)
                                    style="color:rgb(199,201,72)">    Chưa xác nhận
                                    @elseif($contract->status==1)
                                    style="color:green">    Đã xác nhận
                                    @elseif($contract->status==2)
                                    style="color:red">    Hủy hợp đồng
                                    @endif
                                </p>
                                @if($contract->check==1 && ($contract->status==0 || $contract->status==1))
                                <ul class="job-dashboard-actions">
                                    <li><button onclick="return action_{{$contract->id}}();">Xác nhận</button></li>
                                    <li><button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button></li>
                                </ul>
                                @endif
                            </td>
                            <td class="expires">{{$contract->description}}</td>
                            <td class="filled">{{number_format($contract->money)}} VND</td>
                        </tr>
                        {{-- ajax --}}
                        <script>
                            function action_{{$contract->id}}(){
                                $.ajax({
                                    type:'GET',
                                    url:'{{asset('parent/contract/accept')}}/{{$contract->id}}',
                                    success:function(data){
                                        location.reload();
                                        // document.getElementById('confirm{{$contract->id}}').innerHTML="Đã xác nhận";
                                    }
                                });
                            }

                            function cancel_{{$contract->id}}() {
                                $.ajax({
                                    type:'GET',
                                    url:'{{asset('parent/contract/cancel')}}/{{$contract->id}}',
                                    success:function(data){
                                        location.reload();
                                        // document.getElementById('confirm{{$contract->id}}').innerHTML="Đã Hủy";
                                    }
                                });
                            }
                        </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
<!-- Page Content / End -->
@endsection
