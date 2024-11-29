@extends('vendor.mail.html.layout')

@section('content')
<h2>Hello, {{ $user->username }}</h2>
<p>You are receiving this email because we received a password reset request for your account.</p>
<a href="{{ $resetUrl }}" class="button">Reset Password</a>
<p>If you did not request a password reset, no further action is required.</p>
<p>Thank you,<br>Fast Finance Cars Team</p>
@endsection
