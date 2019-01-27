@component('mail::message')
# Important information on your account!

Your account has been updated with the following login credentials:

    Username: {{ $user->email }}

    Password: {{ $password ?: 'Your password has not changed.'   }}

Once you sign in, please feel free to change your credentials.

Yours,<br>
{{ config('app.name') }}
@endcomponent