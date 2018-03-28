@extends('layouts.app')
@section('page-title')  Bookings @endsection

@section('title')   Bookings  @endsection

@section('activeBookings') active-sub active @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Bookings</a></li>
    </ol>
@endsection
@section('content')
    @role('customer')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Vehicle Bookings
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-response">
                            <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>Vehicle </th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Total Amount</th>
                                <th>With Fuel </th>
                                <th>Payment Status</th>
                                <th>Booking status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Booking::where('user_id',auth()->user()->id)->get() as $serial => $booking)
                                <tr>
                                    <td>{{$booking->id}}</td>
                                    <td>{{\App\VehicleType::find($booking->vehicle_type_id)->name}}</td>
                                    <td>{{date('Y-m-d',strtotime($booking->start_date))}}</td>
                                    <td>{{date('Y-m-d',strtotime($booking->end_date))}}</td>
                                    <td>{{\App\BookingPaymentInformation::where('booking_id',$booking->id)->first()->duration}}</td>
                                    <td>
                                        {{number_format(\App\BookingPaymentInformation::where('booking_id',$booking->id)->first()->total_amount,2)}}
                                    </td>
                                    <td>
                                        @if($booking->fuel == 1)
                                            <label class="label label-success">With Fuel</label>
                                        @else
                                            <label class="label label-danger">Without Fuel</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->payment_status == 1)
                                            <label class="label label-success">Successful</label>
                                        @elseif($booking->payment_status == 0)
                                            <label class="label label-danger">Incomplete</label>
                                        @elseif($booking->payment_status == 2)
                                            <label class="label label-warning">Pending</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->booking_status == 1)
                                            <label class="label label-success">Successful</label>
                                        @elseif($booking->booking_status == 0)
                                            <label class="label label-danger">Incomplete</label>
                                        @elseif($booking->booking_status == 2)
                                            <label class="label label-warning">Pending</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('/booking/preview/'.$booking->id)}}" data-toggle="tooltip" class="btn btn-info btn-sm" title="View Booking Information"><i class="fa fa-eye"></i></a>
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

    @role('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                       All Vehicle Bookings
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-response">
                            <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>User Info</th>
                                <th>Vehicle </th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Total Amount</th>
                                <th>With Fuel </th>
                                <th>Payment Status</th>
                                <th>Booking status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Booking::all() as $serial => $booking)
                                <tr>
                                    <td>{{$booking->id}}</td>
                                    <td>{{\App\User::find($booking->user_id)->first_name}} {{\App\User::find($booking->user_id)->middle_name }} {{\App\User::find($booking->user_id)->last_name }}</td>
                                    <td>{{\App\VehicleType::find($booking->vehicle_type_id)->name}}</td>
                                    <td>{{date('Y-m-d',strtotime($booking->start_date))}}</td>
                                    <td>{{date('Y-m-d',strtotime($booking->end_date))}}</td>
                                    <td>{{\App\BookingPaymentInformation::where('booking_id',$booking->id)->first()->duration}}</td>
                                    <td>
                                        {{number_format(\App\BookingPaymentInformation::where('booking_id',$booking->id)->first()->total_amount,2)}}
                                    </td>
                                    <td>
                                        @if($booking->fuel == 1)
                                            <label class="label label-success">With Fuel</label>
                                        @else
                                            <label class="label label-danger">Without Fuel</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->payment_status == 1)
                                            <label class="label label-success">Successful</label>
                                        @elseif($booking->payment_status == 0)
                                            <label class="label label-danger">Incomplete</label>
                                        @elseif($booking->payment_status == 2)
                                            <label class="label label-warning">Pending</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->booking_status == 1)
                                            <label class="label label-success">Successful</label>
                                        @elseif($booking->booking_status == 0)
                                            <label class="label label-danger">Incomplete</label>
                                        @elseif($booking->booking_status == 2)
                                            <label class="label label-warning">Pending</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('/booking/preview/'.$booking->id)}}" data-toggle="tooltip" class="btn btn-info btn-sm" title="View Booking Information"><i class="fa fa-eye"></i></a>
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


@endsection