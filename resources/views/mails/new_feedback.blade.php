@component('mail::message')
# Here is the feedback recieved

Name : {{$data['name']}}

Email : {{$data['email']}}

Phone : {{$data['phone']}}

Message : {{$data['message']}}


Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
