@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo.png')}}" style="height: 100px;" alt="" /></p>

# Hi {{$userInfo->first_name}},
Your attempt to make a payment failed,

@component('mail::panel')
    {{$transactionStatus['response_description']}}
@endcomponent

@component('mail::button', ['url' => url('/login')])
     Login
@endcomponent

Regards,
{{ config('app.name') }}
@endcomponent