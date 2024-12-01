<!-- resources/views/auth/passwords/email.blade.php -->
@extends('layouts.index')

@section('content')
<style>
    .customizerow{
    margin:0 !important;
    margin-top: 20px !important;

}
</style>
<div class="row justify-content-center customizerow">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
