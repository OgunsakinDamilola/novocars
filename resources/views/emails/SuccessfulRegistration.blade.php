@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo.png')}}" style="height: 100px;" alt="" /></p>

Congratulation,

Your registration was successful, login with the email you entered and the password below.
We highly advice you to change the password to your desired password upon login
@component('mail::panel')
> **{{$password}}**
@endcomponent
@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
