@component('mail::message')
# Welcome {{Str::ucfirst($user->first_name)}}

We are happy to get you started.Please click on following button to activate your account.
@component('mail::button', ['url' => $url])
   Activate Account
@endcomponent

If the above button is not working you can directly acccess the link here <a href="{{$url}}">{{$url}}</a>

In case of any issue , you can reach here {{config('mail.from.address')}}


Thanks,<br>
Team {{ config('app.name') }}
@endcomponent