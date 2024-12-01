@extends('layouts.app')

@section('content')
<style type="text/css">

body {
    background: linear-gradient(to right, #ff4e50, #f9d423); /* Red to coral gradient */
    font-family: 'Arial', sans-serif;
}

.container {
    margin-top: 50px;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: linear-gradient(to right, #4e54c8, #8f94fb); /* Blue gradient */
    color: white;
    font-size: 1.5rem;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-body {
    background: white;
    padding: 30px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #ff4e50;
    box-shadow: 0 0 5px rgba(255, 78, 80, 0.5);
}

.btn-primary {
    background: linear-gradient(to right, #ff4e50, #f9d423); /* Red to coral gradient */
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(to right, #f9d423, #ff4e50); /* Coral to red gradient */
}

.invalid-feedback {
    color: #ff4e50;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection