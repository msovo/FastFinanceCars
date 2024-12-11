@extends('layouts.index')

@section('content')

<style>
body {
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
    background: #4e54c8; /* Solid color for header */
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
    border-color: #ff7e5f;
    box-shadow: 0 0 5px rgba(255, 126, 95, 0.5);
}

.btn-primary {
    background: #ff7e5f; /* Solid color for button */
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #feb47b; /* Hover color */
}

.btn-secondary {
    background: #4e54c8;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    color: white;
    transition: background 0.3s ease;
}

.btn-secondary:hover {
    background: #8f94fb;
}

.invalid-feedback {
    color: #ff7e5f;
}

.customizerow{
    margin:0 !important;
    margin-top: 20px !important;

}
</style>

@section('content')
<div class="row justify-content-center customizerow">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Signup</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('signup') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="buyer">Buyer</option>
                                <option value="private_seller">Private Seller</option>
                                <option value="dealer">Dealer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                    <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Your Password?</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection