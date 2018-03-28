@extends('layouts.app')
@section('page-title')  Fees and Rates  @endsection

@section('title')  Fees and Rates  @endsection

@section('activeSettings') active-sub active @endsection
@section('activeFees') active @endsection

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Settings</a></li>
        <li class="active">Fees and Rates</li>
    </ol>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Daily rental rate within & outside Lagos metropolis / Airport Pickup and DropOff</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-bordered-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"> Daily Rental Rate</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <form method="post" action="{{route('save-daily-rental-rate')}}">
                                                    @csrf
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Vehicle  Type</label>
                                                            <select class="form-control" name="vehicle_type_id" required>
                                                                <option value="">[SELECT VEHICLE]</option>
                                                                @foreach($vehicle_types as $i => $vehicle_type)
                                                                    <option value="{{$vehicle_type->id}}">{{$vehicle_type->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Daily Rental Within Lagos Metropolis with Fuel (&#x20A6;)</label>
                                                            <input class="form-control" type="number" value="" name="daily_rental_within_lagos_metropolis_with_fuel" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Daily Rental Within Lagos Metropolis with Fuel (&#x20A6;)</label>
                                                            <input class="form-control" type="number" value="" name="daily_rental_within_lagos_metropolis_without_fuel" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Daily Rental Outside Lagos Metropolis without Fuel (&#x20A6;)</label>
                                                            <input class="form-control" type="number" value="" name="daily_rental_outside_lagos_metropolis_without_fuel" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Rate Per Extra Hour (&#x20A6;)</label>
                                                            <input class="form-control" type="number" value="" name="rate_per_extra_hour" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Airport Pickup and DropOff MainLand (&#x20A6;)</label>
                                                            <input type="number" name="airport_pick_up_drop_off_main_land" class="form-control"  value="" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Airport Pickup and DropOff Island (&#x20A6;)</label>
                                                            <input type="number" name="airport_pick_up_drop_off_island" class="form-control"  value="" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <button class="btn btn-primary btn-block"> Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle Type</th>
                                            <th>Daily Rental Within Lagos Metropolis(With Fuel)</th>
                                            <th>Daily Rental Within Lagos Metropolis(Without Fuel)</th>
                                            <th>Daily Rental Outside Lagos Metropolis(Without Fuel)</th>
                                            <th>Rate Per Extra Hour</th>
                                            <th>Airport Pickup and DropOff(MainLand)</th>
                                            <th>Airport Pickup and DropOff(Island)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($daily_rental_rates as $serial => $daily_rental_rate)
                                            <tr>
                                                <td>{{$serial + 1}}</td>
                                                <td>{{ \App\VehicleType::find($daily_rental_rate->vehicle_type_id)->name}}</td>
                                                <td>{{$daily_rental_rate->daily_rental_within_lagos_metropolis_with_fuel}}</td>
                                                <td>{{$daily_rental_rate->daily_rental_within_lagos_metropolis_without_fuel}}</td>
                                                <td>{{$daily_rental_rate->daily_rental_outside_lagos_metropolis_without_fuel}}</td>
                                                <td>{{$daily_rental_rate->rate_per_extra_hour}}</td>
                                                <td>{{$daily_rental_rate->airport_pick_up_drop_off_main_land}}</td>
                                                <td>{{$daily_rental_rate->airport_pick_up_drop_off_island}}</td>
                                                <td id="status_daily_rental_rate_{{$daily_rental_rate->id}}">
                                                    @if($daily_rental_rate->status == 1)
                                                        <label class="label label-success"><i class="fa fa-check"></i> Active</label>
                                                        @elseif($daily_rental_rate->status == 0)
                                                        <label class="label label-danger"><i class="fa fa-times"></i> Not Active</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button data-toggle="tooltip" data-original-title="Activate"   value="{{$daily_rental_rate->id}}" class="btn btn-success btn-sm activate_daily_rental_rate"><i class="fa fa-check"></i></button>
                                                    <button data-toggle="tooltip" data-original-title="Deactivate" value="{{$daily_rental_rate->id}}" class="btn btn-danger btn-sm deactivate_daily_rental_rate"><i class="fa fa-times"></i></button>
                                                    <button data-toggle="tooltip" data-original-title="Edit Value" value="{{$daily_rental_rate->id}}" class="btn btn-primary btn-sm edit_daily_rental_rate"><i class="fa fa-edit"></i></button>

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
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Driver Outstation allowance : &#x20A6; {{number_format($driver_fee->value,2)}} <b id="drivers_fees"></b></h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="{{route('save-driver-out-station-allowance-fee')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Driver's Outstation allowance</label>
                                            <input type="number" name="daily_driver_outstation_allowance_value" id="daily_driver_outstation_allowance_value" class="form-control" placeholder="Enter amount (e.g 5000)" value="{{$driver_fee->value}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button class="btn btn-primary pull-right btn-block" > Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Inter State Rental Rate</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-bordered-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"> Inter State Rental</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <form method="post" action="{{route('save-inter-state-booking-rates')}}">
                                                            @csrf
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Destination State</label>
                                                                    <select class="form-control" name="destination_state_id" required>
                                                                        <option value="">[SELECT STATE]</option>
                                                                        @foreach($available_states as $i => $available_state)
                                                                            <option value="{{$available_state->id}}">{{$available_state->state}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Vehicle Category</label>
                                                                    <select class="form-control" name="vehicle_category_id" required>
                                                                        <option value="">[SELECT VEHICLE CATEGORY]</option>
                                                                        @foreach($vehicle_categories as $serial => $vehicle_category)
                                                                            <option value="{{$vehicle_category->id}}">{{$vehicle_category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Amount</label>
                                                                    <input type="number" name="state_rental_rate_value" class="form-control"  value="" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>&nbsp;</label>
                                                                    <button class="btn btn-primary btn-block"> Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Inter State Rental Rates</h3>
                        </div>
                        <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Destination State</th>
                            <th>Vehicle Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inter_state_booking_rates as $serial => $inter_state_booking_rate)
                            <tr>
                                <td>{{$serial+1}}</td>
                                <td>{{\App\State::find($inter_state_booking_rate->destination_state_id)->state}}</td>
                                <td>{{\App\VehicleCategory::find($inter_state_booking_rate->vehicle_category_id)->name}}</td>
                                <td>{{number_format($inter_state_booking_rate->state_rental_rate_value)}}</td>
                                <td id="inter_state_booking_{{$inter_state_booking_rate->id}}">
                                    @if($inter_state_booking_rate->status == 1)
                                        <label class="label label-success"><i class="fa fa-check"></i> Active</label>
                                    @elseif($inter_state_booking_rate->status ==0)
                                        <label class="label label-danger"><i class="fa fa-check"></i> Not Active</label>
                                    @endif
                                </td>
                                <td>
                                    <button data-toggle="tooltip" data-original-title="Activate"   class="btn btn-success btn-sm activate_inter_state_rate"  value="{{$inter_state_booking_rate->id}}">    <i class="fa fa-check"></i> </button>
                                    <button data-toggle="tooltip" data-original-title="Deactivate" class="btn btn-danger btn-sm deactivate_inter_state_rate" value="{{$inter_state_booking_rate->id}}">    <i class="fa fa-times"></i> </button>
                                    <button data-toggle="tooltip" data-original-title="Edit Value" class="btn btn-primary btn-sm edit_inter_state_rate"      value="{{$inter_state_booking_rate->id}}">    <i class="fa fa-edit"></i>  </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
                </div>

@endsection

@section('javascript')
    <script src="{{asset('js/pages/settings/fees.js')}}"></script>
@endsection