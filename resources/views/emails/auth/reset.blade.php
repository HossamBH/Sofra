@component('mail::message')
# Introduction

Sofra Reset password.

@component('mail::button', ['url' => 'http://facebook.com'])
Reset
@endcomponent

<p>Your Reset Code is: {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

