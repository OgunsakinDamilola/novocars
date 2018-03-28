@extends('layouts.app')
@section('page-title')  Transaction Logs @endsection

@section('title')   Transaction Logs  @endsection

@section('activeTransactionLogs') active-sub active @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Transaction Logs</a></li>
    </ol>
@endsection
@section('content')
@role('admin')
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Online Payments
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>Reference </th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                            <th>Response Code</th>
                            <th>Response Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\OnlinePayment::where('payment_status','!=','2')->get() as $serial => $log)
                            <tr>
                                <td>{{$log->booking_id}}</td>
                                <td>{{$log->reference}}</td>
                                <td>
                                    {{\App\User::find($log->user_id)->first_name}}
                                    {{\App\User::find($log->user_id)->middle_name}}
                                    {{\App\User::find($log->user_id)->last_name}}
                                </td>
                                <td>{{number_format(($log->amount/100),2)}}</td>
                                <td>{{date('Y-m-d G:i:A',strtotime($log->created_at))}}</td>
                                <td id="response_code_{{$log->reference}}">{{$log->response_code}}</td>
                                <td id="response_description_{{$log->reference}}">{{$log->response_description}}</td>
                                <td>
                                    @if($log->payment_status == 1)
                                    @elseif($log->payment_status == 0)
                                        <button class="btn btn-primary btn-sm requery" type="button" value="{{$log->reference}}">Requery</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Offline Payments
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>Reference </th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\OfflinePayment::all() as $serial => $log)
                            <tr id="table_row_{{$log->reference}}">
                                <td>{{$log->booking_id}}</td>
                                <td>{{$log->reference}}</td>
                                <td>
                                    {{\App\User::find($log->user_id)->first_name}}
                                    {{\App\User::find($log->user_id)->middle_name}}
                                    {{\App\User::find($log->user_id)->last_name}}
                                </td>
                                <td>{{number_format(($log->amount/100),2)}}</td>
                                <td>{{date('Y-m-d G:i:A',strtotime($log->created_at))}}</td>
                                <td>
                                    @if($log->payment_status == 0)
                                       <label class="label label-danger">Failed</label>
                                    @elseif($log->payment_status == 1)
                                        <label class="label label-success">Successful</label>
                                    @elseif($log->payment_status == 2)
                                        <label class="label label-warning">Pending</label>
                                    @endif
                                </td>
                                <td id="offline_payment_status_{{$log->reference}}">
                                    <button class="btn btn-success btn-sm confirm_payment" data-toggle="tooltip" title="Confirm Payment/Booking" type="button" value="{{$log->reference}}"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-danger btn-sm decline_payment" data-toggle="tooltip" title="Decline Payment/Booking" type="button" value="{{$log->reference}}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endrole

@role('customer')
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Online Payments
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>Reference </th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                            <th>Response Code</th>
                            <th>Response Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userOnlinePayments as $serial => $log)
                            <tr>
                                <td>{{$log->booking_id}}</td>
                                <td>{{$log->reference}}</td>
                                <td>{{number_format(($log->amount/100),2)}}</td>
                                <td>{{date('Y-m-d G:i:A',strtotime($log->created_at))}}</td>
                                <td id="response_code_{{$log->reference}}">{{$log->response_code}}</td>
                                <td id="response_description_{{$log->reference}}">{{$log->response_description}}</td>
                                <td>
                                    @if($log->payment_status == 1)
                                    @elseif($log->payment_status == 0)
                                        <button class="btn btn-primary btn-sm requery" type="button" value="{{$log->reference}}">Requery</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Offline Payments
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-response">
                        <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>Reference </th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                            <th>Payment Status</th>
                            {{--<th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userOfflinePayments as $serial => $log)
                            <tr id="table_row_{{$log->reference}}">
                                <td>{{$log->booking_id}}</td>
                                <td>{{$log->reference}}</td>
                                <td>
                                    {{\App\User::find($log->user_id)->first_name}}
                                    {{\App\User::find($log->user_id)->middle_name}}
                                    {{\App\User::find($log->user_id)->last_name}}
                                </td>
                                <td>{{number_format(($log->amount/100),2)}}</td>
                                <td>{{date('Y-m-d G:i:A',strtotime($log->created_at))}}</td>
                                <td id="offline_payment_status_{{$log->reference}}">
                                    @if($log->payment_status == 0)
                                        <label class="label label-danger">Failed</label>
                                    @elseif($log->payment_status == 1)
                                        <label class="label label-success">Successful</label>
                                    @elseif($log->payment_status == 2)
                                        <label class="label label-warning">Pending</label>
                                    @endif
                                </td>
                                {{--<td>--}}
                                    {{--<button class="btn btn-success btn-sm confirm_payment" data-toggle="tooltip" title="Confirm Payment/Booking" type="button" value="{{$log->reference}}"><i class="fa fa-check"></i></button>--}}
                                    {{--<button class="btn btn-danger btn-sm decline_payment" data-toggle="tooltip" title="Decline Payment/Booking" type="button" value="{{$log->reference}}"><i class="fa fa-times"></i></button>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endrole

@endsection

@section('javascript')
<script src="{{asset('js/pages/transaction_logs.js')}}"></script>
@endsection
