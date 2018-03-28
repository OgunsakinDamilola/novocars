@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo.png')}}" style="height: 100px;" alt="" /></p>

# Hi {{$userInfo->first_name}},
Your account password has been changed successfully

@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

@component('mail::panel')
> New Password :  **{{$password}}**
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
