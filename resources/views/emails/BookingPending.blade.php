@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo.png')}}" style="height: 100px;" alt="" /></p>
# Hi {{$userInfo->first_name}},
Your booking is placed on hold and is hereby pending. Kindly complete your payment for your booking to be successful
@component('mail::panel')
 > Booking No: **{{$bookingInfo->id}}**
@endcomponent
@component('mail::table')
| Booking Details                   |                                                                                                                                                                                   |
| --------------------------------- |:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| Selected Vehicle                  | {{\App\VehicleType::find($bookingInfo->vehicle_type_id)->name}} ({{\App\VehicleCategory::find(\App\VehicleType::find($bookingInfo->vehicle_type_id)->category_id)->name}})        |
| Destination Sate                  | {{\App\State::find($bookingInfo->destination_state_id)->state}}                                                                                                                   |
| Start Date                        | {{date('d, D M Y',strtotime($bookingInfo->start_date))}}                                                                                                                          |
| End Date                          | {{date('d, D M Y',strtotime($bookingInfo->end_date))}}                                                                                                                            |
| Number Of Days                    | {{$bookingPaymentInfo->duration}} day(s)                                                                                                                                          |
| Sub Total                         | &#x20A6;{{number_format(($bookingPaymentInfo->total_amount - $bookingPaymentInfo->discount),2) }}                                                                                 |
| Discount                          | &#x20A6;{{number_format(($bookingPaymentInfo->discount),2) }}                                                                                                                     |
| Total Amount                      | &#x20A6;{{number_format(($bookingPaymentInfo->total_amount),2) }}                                                                                                                 |
@endcomponent
@component('mail::button', ['url' => url('/login')])
Login
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
