@component('mail::message')
# Welcome to {{ config('app.name') }}.

Your account has been created with the following login credentials:

    Username: {{ $user->email }}

    Password: {{ $password }}

Once you sign in, please feel free to change your credentials.

Yours,<br>
{{ config('app.name') }}
@endcomponent
