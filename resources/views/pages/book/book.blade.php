@extends('layouts.app')
@section('page-title')  Book a vehicle @endsection

@section('title')   Book a vehicle  @endsection

@section('activeBook') active-sub active @endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-car"></i></a></li>
        <li><a href="#"> Book</a></li>
        <li class="active">Booking a vehicle</li>
    </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"> Book a vehicle</h3>
            </div>
            <div class="panel panel-body">
                <div class="row">
                    <div class="col-md-3 eq-box-md text-center bord-hor">

                        <!-- Simple Promotion Widget -->
                        <!--===================================================-->
                        <div class="box-vmiddle pad-all">
                            <h5 class="text-main">Important Information</h5>
                            <p class="pad-btn text-md" style="text-align: justify;">Driver outstation allowance is
                                <span class="text-md text-bold text-main"> &#x20a6;{{$driver_fee}}</span>.
                                This money is paid whenever a driver is staying overnight with the car
                                and this always happens when the booking lasts for more than one day,
                                or the booking is outside the state.
                            </p>
                            <p style="text-align: justify" class="text-md">
                                For bookings that are not within Lagos Metropolis. The vehicle will not be fueled.
                            </p>
                            <p style="text-align: justify" class="text-md">
                               Areas outside Lagos Metropolis are: Badagry, Ikorodu Town, Sango Ota, Ayobo, Ipaja, Agbara, Ijanikin, Mowe, Ibafo, Arepo,
                                Alagbado, Epe, Akute, Eleko, Lakowe.
                            </p>

                            <br>
                        </div>
                        <!--===================================================-->

                    </div>
                    <div class="col-md-9 eq-box-md eq-no-panel">
                        <div id="demo-bv-wz">
                            <div class="wz-heading pad-top">

                                <!--Nav-->
                                <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
                                    <li class="col-xs-3">
                                        <a data-toggle="tab" href="#demo-bv-tab1">
                                            <span class="text-info"><i class="demo-pli-map-marker-2 icon-2x"></i></span>
                                            <p class="text-semibold mar-no"> PickUp / DropOff</p>
                                        </a>
                                    </li>
                                    <li class="col-xs-3">
                                        <a data-toggle="tab" href="#demo-bv-tab2">
                                            <span class="text-info"><i class="fa fa-car fa-2x"></i></span>
                                            <p class="text-semibold mar-no">Vehicle Info</p>
                                        </a>
                                    </li>
                                    <li class="col-xs-3">
                                        <a data-toggle="tab" href="#demo-bv-tab3">
                                            <span class="text-info"><i class="demo-pli-male-female icon-2x"></i></span>
                                            <p class="text-semibold mar-no">Customer Info</p>
                                        </a>
                                    </li>
                                    <li class="col-xs-3">
                                        <a data-toggle="tab" href="#demo-bv-tab4">
                                            <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
                                            <p class="text-semibold mar-no">Finish</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!--progress bar-->
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-primary"></div>
                            </div>


                            <!--Form-->
                            <form id="demo-bv-wz-form" class="form-horizontal" method="post" action="{{route('submit-booking')}}">
                                @csrf
                                <input type="hidden" name="id"/>
                                <div class="panel-body">
                                    <div class="tab-content">

                                        <!--First tab-->
                                        <div id="demo-bv-tab1" class="tab-pane">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">Origin State</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" disabled="" class="form-control" name="" placeholder="" value="Lagos State">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">Destination State</label>
                                                        <div class="col-lg-8">
                                                            <select class="form-control" name="destination_state_id" required>
                                                                <option value="">[SELECT DESTINATION STATE]</option>
                                                                @foreach($available_states as $serial => $available_state)
                                                                    <option value="{{$available_state}}">{{\App\State::find($available_state)->state}}</option>
                                                                @endforeach
                                                                    <option value="24"> Lagos </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">Start Date</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control datepicker" name="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">End Date</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control datepicker" name="end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 control-label">Pick Up Address</label>
                                                        <div class="col-lg-8">
                                                        <textarea class="form-control" name="pick_up_address" required placeholder="Any address you will like our driver to pick you from" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!--Second tab-->
                                        <div id="demo-bv-tab2" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control vehicle_type" name="vehicle_type" required>
                                                                <option value="">[SELECT VEHICLE]</option>
                                                                @foreach($daily_rates as $serial => $daily_rate)
                                                                    <option value="{{$daily_rate->vehicle_type_id}}"> {{\App\VehicleType::find($daily_rate->vehicle_type_id)->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="all_options">

                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <img src="" class="img-responsive" id="vehicle_image" style="width: 80%; height: 250px;"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Third tab-->
                                        <div id="demo-bv-tab3" class="tab-pane">
                                            <div id="login_field" class="well row @if(auth()->user()) hidden  @endif">
                                                <div class="col-md-12">
                                                    <h6>Please login or register to continue. <a href="#register_field"  class="btn btn-primary btn-sm" id="show_register_form"> Register here .</a> </h6>
                                                    <div id="login_form">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-4">Email</label>
                                                                <div class="col-lg-8">
                                                                    <input type="email" name="login_email" required class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-4">Password</label>
                                                                <div class="col-lg-8">
                                                                    <input type="password" name="login_password" required class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="col-lg-12">
                                                                    <button class="btn btn-block btn-primary" type="button" id="login_button">Login</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div  id="register_field" class="row hidden @if(auth()->user()) hidden  @endif">
                                                        <div id="register_form">
                                                            <div class="panel panel-bordered-default">
                                                                <div class="panel-body">
                                                                    <div class="row">

                                                                        <div class="col-md-12">
                                                                            <h6>New customers, kindly provide us with the following information</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-4">First Name</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text"  name="register_first_name" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-4">Middle Name</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text"  name="register_middle_name" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-4">Last Name</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text" name="register_last_name" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-4">Email</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text"  name="register_email" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-4">Phone number</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text"  name="register_phone_number" class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="col-md-4">

                                                                                </div>
                                                                                <div class="col-lg-8">
                                                                                    <button class="btn btn-primary btn-block" type="button" id="register_button"> Register</button>
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
                                            <div id="agree_field" class="row @if(auth()->guest()) hidden @endif">
                                                <div class="col-md-12">
                                                    <label> Your are logged in, your information will be attached to the booking, please agree to continue your booking.</label>
                                                    <div class="checkbox pad-btm text-left">
                                                        <input type="checkbox" id="i_agree" name="i_agree" class="magic-checkbox" required/>
                                                        <label for="i_agree"> I agree</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Fourth tab-->
                                        <div id="demo-bv-tab4" class="tab-pane  mar-btm text-center">
                                            <h4>Thank you</h4>
                                            <p class="text-muted">
                                                Please confirm your bookings options before clicking on the continue button. You will be taken to your payment information page from here.</p>
                                        </div>
                                    </div>
                                </div>

                                <!--Footer button-->
                                <div class="panel-footer text-right">
                                    <div class="box-inline">
                                        <button type="button" class="previous btn btn-primary">        Previous</button>
                                        <button type="button" class="next btn btn-primary">            Next</button>
                                        <button type="submit" class="finish btn btn-warning" disabled> Continue</button>
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
@endsection
@section('javascript')
<script src="{{asset('js/demo/form-wizard.js')}}"></script>
<script src="{{asset('js/pages/book/book.js')}}"></script>
@endsection

