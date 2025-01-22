<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('dashboard-overview')
<h2>Dashboard Overview</h2>
<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Users</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totals['totalUsers']  }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Total Listings</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totals['totalListings'] }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Total Enquiries</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totals['totalEnquiries']}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Total Reviews</div>
            <div class="card-body">
                <h5 class="card-title">{{  $totals['totalReviews'] }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-12" id="adminContent" style="height:50vh;overflow-y:scroll;">
        <!-- Dynamic content will be loaded here -->
    </div>
    <div class="col-md-12 mt-2" id="closeButtonContainer" style="display:none;">
        <button id="closeButton" class="btn btn-secondary">Close</button>
    </div>
</div>
@endsection
