@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body text-center">
                    <h5>Welcome, {{ Auth::user()->username }}</h5>
                    @if (Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="img-thumbnail" alt="Profile Image" width="150">
                    @else
                        <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Profile Image">
                    @endif
                    <p class="mt-3">Thank you for joining FAST FINANCE CARS. We welcome you to our community and hope you find the dream car you have been hoping for. Regards, Management.</p>
                    <a href="{{ route('user.profile', Auth::user()->user_id) }}" class="btn btn-primary mt-3">View Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger mt-3"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection