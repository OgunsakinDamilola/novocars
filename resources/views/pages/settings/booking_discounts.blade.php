@extends('layouts.app')
@section('page-title')  Booking Discounts  @endsection

@section('title')   Booking Discounts  @endsection

@section('activeSettings') active-sub active @endsection

@section('activeDiscounts') active  @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Settings</a></li>
        <li class="active">Booking Discounts</li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Booking Discounts</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-bordered-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Booking Discounts</h3>
                                </div>
                                <div class="panel-body">
                                    <form method="post" action="{{route('save-discount')}}">
                                        @csrf
                                        <input type="hidden" name="discount_id" id="discount_id" value=""/>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Number of Booking Days</label>
                                                    <input type="number" value="" id="booking_days" name="booking_days" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label> Discount Value (&#x20A6;)</label>
                                                    <input type="number" value="" id="discount_value" name="discount_value" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-primary btn-sm btn-block">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking Days</th>
                                    <th>&#x20A6; Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($booking_discounts as $serial => $booking_discount)
                                    <tr>
                                        <td>{{$serial + 1}}</td>
                                        <td>{{$booking_discount->days}}</td>
                                        <td>{{number_format($booking_discount->value)}}</td>
                                        <td id="status_{{$booking_discount->id}}">
                                            @if($booking_discount->status == 1)
                                                <label class="label label-success"><i class="fa fa-check"></i> Active</label>
                                            @elseif($booking_discount->status == 0)
                                                <label class="label label-danger"> <i class="fa fa-times"></i> Not Active</label>
                                            @endif
                                        </td>
                                        <td>
                                            <button data-toggle="tooltip" data-original-title="Activate booking discount" value="{{$booking_discount->id}}" class="btn btn-success btn-sm activate"><i class="fa fa-check"></i></button>
                                            <button data-toggle="tooltip" data-original-title="Deactivate booking discount" value="{{$booking_discount->id}}" class="btn btn-danger btn-sm deactivate"><i class="fa fa-times"></i></button>
                                            <button data-toggle="tooltip" data-original-title="Edit booking discount" value="{{$booking_discount->id}}" class="btn btn-primary btn-sm edit"><i class="fa fa-edit"></i></button>
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
    </div>


@endsection

@section('javascript')
<script src="{{asset('js/pages/settings/booking_discounts.js')}}"></script>
@endsection