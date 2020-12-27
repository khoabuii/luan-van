@extends('layouts.sittersLayout.sitter_app')
@section('title','Danh sách hợp đồng')
@section('content')

<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <h4>Danh sách hợp đồng</h4>
        <div id="job-manager-job-dashboard">
            <div class="table-responsive">
                <table id="contract" class="job-manager-jobs table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th width="10%">ID hợp đồng</th>
                            <th class="expires" width="28%">Phụ huynh</th>
                            <th class="date">Thời gian gửi</th>
                            <th class="status" width="20%">Trạng thái</th>
                            <th class="filled" width="15%">Tiền thù lao</th>
                            <th>Xem chi tiết</th>
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
                                    <a href="{{asset('sitter/parent_profile')}}/{{$contract->parent}}" class="job_title_link">{{$contract->parent_name}}</a>
                                    @if($contract->check==1)(Người gửi yêu cầu) @endif
                                    <br>
                                    <img src="{{asset('uploads/parents_profile')}}/{{$contract->parent_img}}" width="50%">
                                </center>
                            </td>
                            <td class="date">{{$contract->created_at}}</td>
                            <td class="status">
                                <p id="confirm{{$contract->id}}"
                                    @if($contract->status==0)
                                     style="color:rgb(199,201,72)">   Chưa xác nhận
                                    @elseif($contract->status==1)
                                     style="color:green" >  Đã xác nhận
                                    @elseif($contract->status==2)
                                     style="color:red" > Hủy hợp đồng
                                    @endif
                                </p>
                                @if($contract->check==1 && $contract->status==0)
                                    <ul class="job-dashboard-actions">
                                        <li><button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button></li>
                                        <li><button onclick="return action_{{$contract->id}}();">Xác nhận</button></li>
                                    </ul>
                                @elseif($contract->status==0 || $contract->status==1)
                                    <ul class="job-dashboard-actions">
                                        <li><button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button></li>
                                    </ul>
                                @endif
                            </td>
                            <td class="filled">{{number_format($contract->money)}} VND</td>
                            <td>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#detail_{{$contract->id}}">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @foreach($contracts as $contract)
                            {{-- modal --}}
                            <div class="modal fade" id="detail_{{$contract->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <center>
                                            <h5 class="modal-title">Xem chi tiết hợp đồng: <span style="color: blue">{{$contract->id}}</span></h5>
                                        </center>
                                    </div>
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
                                            @if($contract->check==1 && $contract->status==0)
                                                <ul class="job-dashboard-actions">
                                                    <li><button onclick="return action_{{$contract->id}}();">Xác nhận</button></li>
                                                    <li><button onclick="return cancel_{{$contract->id}}();">Hủy hợp đồng</button></li>
                                                </ul>
                                            @elseif($contract->status==0 || $contract->status==1)
                                            <ul>
                                                <li style="display: inline;">
                                                    <button onclick="return cancel_{{$contract->id}}"> Hủy hợp đồng</button>
                                                </li>
                                            </ul>
                                            @endif
                                        </h5>
                                        <p>
                                            @if($contract->check==1)
                                                Bạn là người gửi thông tin yêu cầu làm việc.
                                            @elseif($contract->check==0)
                                               Phụ huynh là người gửi thông tin làm việc.
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
                                    <div class="modal-footer">
                                        <a href="{{url('sitter/contract/pdf/'.$contract->id)}}" class="btn btn-primary">Xuat File PDF</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            {{-- ajax --}}
                             <script>
                                function action_{{$contract->id}}(){
                                    $.ajax({
                                        type:'GET',
                                        url:'{{asset('sitter/contract/accept')}}/{{$contract->id}}',
                                        success:function(data){
                                            location.reload();
                                        }
                                    });
                                }
                                function cancel_{{$contract->id}}() {
                                    $.ajax({
                                        type:'GET',
                                        url:'{{asset('sitter/contract/cancel')}}/{{$contract->id}}',
                                        success:function(data){
                                            location.reload();
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

<script>

</script>
@endsection
