@component('mail::message')
# Introduction

Hello {{ $user->name }}!
Your code is {{ $code }}.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
