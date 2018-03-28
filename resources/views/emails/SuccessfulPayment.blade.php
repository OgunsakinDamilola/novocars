@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo.png')}}" style="height: 100px;" alt="" /></p>
# Dear {{$userInfo->first_name}},
Your payment of &#x20A6;{{number_format(($transactionStatus['amount'] / 100),2) }} was successful.

@component('mail::table')
    | Transaction Details        |                                                                      |
    | -------------------------- |:--------------------------------------------------------------------:|
    | Transaction Reference      | {{$transactionStatus['reference']}}                                  |
    | Amount Paid                | &#x20A6;{{number_format(($transactionStatus['amount'] / 100),2) }}   |
@endcomponent

@component('mail::panel')
  An email containing your booking information has also been sent to you
@endcomponent
@component('mail::button', ['url' => url('/bookings')])
 Bookings
@endcomponent

Regards,
{{ config('app.name') }}
@endcomponent
