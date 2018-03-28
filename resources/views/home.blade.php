@extends('layouts.app')
@section('page-title')  Dashboard @endsection

@section('title')   Dashboard  @endsection

@section('activeDashBoard') active-sub active @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Dashboard</a></li>
    </ol>
@endsection
@section('content')
@role('admin')

<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Vehicle Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::all())}} Total Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::where('payment_status',1)->get())}} Payed Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::where('payment_status','!=','1')->get())}} Incomplete Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
</div>

@endrole

@role('customer')

<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Vehicle Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::where('user_id',auth()->user()->id)->get())}} Total Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::where('payment_status',1)->where('user_id',auth()->user()->id)->get())}} Payed Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="pad-ver mar-top text-main"><i class="fa fa-car fa-4x"></i></div>
                <p class="text-lg text-semibold mar-no text-main">Booking(s)</p>
                <p class="text-muted">{{count(\App\Booking::where('payment_status','!=','1')->where('user_id',auth()->user()->id)->get())}} Incomplete Booking(s)</p>
                <p class="text-sm">Total number of booking attempted by you and customers on the system</p>
                <a href="{{route('vehicle-bookings')}}" class="btn btn-primary mar-ver">More Details</a>
            </div>
        </div>
    </div>
</div>

@endrole


@endsection