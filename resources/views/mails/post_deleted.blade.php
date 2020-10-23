@component('mail::message')
Greetings {{Str::ucfirst($user->first_name)}},

Your {{$type =='product' ? 'Product' : 'Product Request'}} with title '{{$title}}' was deleted automatically.


In case of any issue , you can reach here {{config('mail.from.address')}}


Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
