@component('mail::message')
<h1>Congratulation {{ $details['name'] }}!</h1>
<h3>Your password is updated successfully.</h3>
<h3>Your password is - {{ $details['password'] }}</h3>
<p>Thank you</p>
@endcomponent