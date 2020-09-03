@component('mail::message')
        # Hello,
        You are receiving this email because we received a password reset request for your account.

        This password reset link will expire in {{ config('auth.passwords.users.expire') }} minutes.
        If you did not request a password reset, no further action is required.
        [Reset paassword]({{$link}}

    {{ config('app.name') }} team
@endcomponent
