<!-- resources/views/auth/verify-email.blade.php -->
@extends('layouts.index')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Verify Your Email Address</div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <p>Before proceeding, please check your email for a verification link.</p>
                <p>If you did not receive the email,</p>
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Click here to request another</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
