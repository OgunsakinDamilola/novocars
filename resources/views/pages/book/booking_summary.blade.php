@extends('layouts.app')
@section('page-title')  Booking Summary @endsection

{{--@section('title')   Booking Summary  @endsection--}}

@section('activeBook') active-sub active @endsection

@section('content')
    <div id="page-content">

        <div class="panel">
            <div class="panel-body">
                <div class="invoice-masthead">
                    <div class="invoice-text">
                        <h3 class="h3 text-uppercase text-thin mar-no text-primary">Booking Summary</h3>
                    </div>
                    <div class="invoice-brand" style="white-space:nowrap">
                        <div class="invoice-logo">
                            <img src="{{asset('img/logo.png')}}" style="height: 150px;">
                        </div>
                    </div>
                </div>

                <div class="invoice-bill row">
                    <div class="col-sm-6 text-xs-center">
                        <address>
                            <strong class="text-main">Novo Car Rentals Limited</strong><br>
                            Novo customer service<br>
                            08147076117, 09091135645, <br/> 012717069, 012702047
                        </address>
                    </div>
                    <div class="col-sm-6 text-xs-center">
                        <table class="invoice-details">
                            <tbody>
                            <tr>
                                <td class="text-main text-bold">Payment Reference #</td>
                                <td class="text-right text-info text-bold">{{$transactionInfo['reference']}}</td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">Booking No</td>
                                <td class="text-right"><span class="badge badge-success">{{$transactionInfo['booking_id']}}</span></td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">Billing Date</td>
                                <td class="text-right">{{date("Y-m-d")}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="new-section-sm bord-no">

                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-bordered invoice-summary">
                            <thead>
                            <tr class="bg-trans-dark">
                                <th class="text-uppercase">Description</th>
                                <th class="min-col text-center text-uppercase">Duration </th>
                                <th class="min-col text-center text-uppercase">Price</th>
                                <th class="min-col text-right text-uppercase">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <strong>Driver Outstation Allowance</strong>
                                    <small>This amount is paid whenever the booking last for more than a day and the driver will be doing sleepover(s) with the vehicle</small>
                                </td>
                                <td class="text-center">{{$bookingPaymentInfo['duration'] - 1}} night(s)</td>
                                @if(($bookingPaymentInfo['duration'] - 1) == 0)
                                    <td class="text-center">&#x20A6;{{number_format(0,2)}}</td>
                                @else
                                    <td class="text-center">&#x20A6;{{number_format(($bookingPaymentInfo['driver_outstation_fee'] / ($bookingPaymentInfo['duration'] - 1)),2)}}</td>
                                @endif
                                <td class="text-right">&#x20A6;{{number_format($bookingPaymentInfo['driver_outstation_fee'],2)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Vehicle - {{\App\VehicleType::find($bookingInfo->vehicle_type_id)->name}} ({{\App\VehicleCategory::find(\App\VehicleType::find($bookingInfo->vehicle_type_id)->category_id)->name}}) -
                                        @if($bookingInfo->fuel == 1) With Fuel @elseif($bookingInfo->fuel == 0) Without Fuel @endif -
                                        @if($bookingInfo->with_lagos_metro == 1) Within Lagos Metropolis @elseif($bookingInfo->fuel == 0) Outside lagos Metropolis @endif
                                    </strong>
                                    <small>Daily rates also applies for destination outside lagos if the vehicle will be used with in the destination location. This daily rates start counting from the second day only for destination outside lagos</small>
                                </td>
                                @if(((($bookingPaymentInfo['duration'] - 1) < 2) && $bookingInfo->with_lagos_metro == 0) || ($bookingInfo->destination_state_id != 24))
                                    <td class="text-center">{{$bookingPaymentInfo['duration']}} <small>({{$bookingPaymentInfo['duration'] - 1}})</small> day(s) </td>
                                    @if(($bookingPaymentInfo['duration'] - 1) < 2)
                                        <td class="text-center">&#x20A6;{{number_format($bookingPaymentInfo['daily_rental_rate_amount'],2)}}</td>
                                    @else
                                        <td class="text-center">&#x20A6;{{number_format(($bookingPaymentInfo['daily_rental_rate_amount']/ ($bookingPaymentInfo['duration'] - 1)),2)}}</td>
                                    @endif                                @else
                                    <td class="text-center">{{$bookingPaymentInfo['duration']}} day(s)</td>
                                    <td class="text-center">&#x20A6;{{number_format(($bookingPaymentInfo['daily_rental_rate_amount'] / $bookingPaymentInfo['duration']),2)}}</td>
                                @endif
                                <td class="text-right">&#x20A6;{{number_format($bookingPaymentInfo['daily_rental_rate_amount'],2)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Destination State : {{\App\State::find($bookingInfo->destination_state_id)->state}}</strong>
                                    <small>Every other destination states apart from lagos have a fixed booking price based on the category of the vehicle you are booking.</small>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-right">&#x20A6;{{number_format($bookingPaymentInfo->vehicle_state_price,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="clearfix">
                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>&#x20A6;{{number_format(($bookingPaymentInfo['total_amount'] - $bookingPaymentInfo['discount']),2)}}</td>
                        </tr>
                        <tr>
                            <td><strong>Discount :</strong></td>
                            <td>&#x20A6;{{number_format($bookingPaymentInfo['discount'],2)}}</td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td class="text-bold h4">&#x20A6;{{number_format($bookingPaymentInfo['total_amount'],2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-right no-print">
                    <a href="javascript:window.print()" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
                    <a href="{{url('/payment/confirmation/'.$transactionInfo['reference'])}}" class="btn btn-info">Pay Later <i class="fa fa-money"></i></a>&nbsp;
                        <form method="post" class="pull-right" action="{{$transactionInfo['action_url']}}">
                            <input type="hidden" class="reference_1" name="txn_ref" value="{{$transactionInfo['reference']}}"/>
                            <input type="hidden" class="amount_1" name="amount" value="{{$transactionInfo['amount']}}"/>
                            <input type="hidden" name="currency" value="566"/>
                            <input type="hidden" name="pay_item_id" value="{{$transactionInfo['item_id']}}"/>
                            <input type="hidden" name="site_redirect_url" value="{{$transactionInfo['redirect_url']}}"/>
                            <input type="hidden" name="product_id" value="{{$transactionInfo['product_id']}}"/>
                            <input type="hidden" class="cust_id_1" name="cust_id" value="{{auth()->user()->id}}"/>
                            <input type="hidden" name="cust_name" value="{{auth()->user()->first_name }} {{auth()->user()->last_name}}"/>
                            <input type="hidden" name="hash" value="{{$transactionInfo['hash']}}"/>
                            <button class="btn btn-primary" type="submit">Pay Now <i class="fa fa-credit-card-alt"></i></button>
                        </form>
                </div>
                <hr class="new-section-sm bord-no">
            </div>
        </div>




    </div>

@endsection