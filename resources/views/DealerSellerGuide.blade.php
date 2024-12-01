@extends('layouts.index')

@section('content')

<style>
    .card {
    border-radius: 10px;
    padding: 15px;
}

.card h5, .card h6 {
    font-weight: bold;
}

.card i {
    font-size: 24px;
}

.text-muted {
    font-size: 14px;
    margin-bottom: 10px;
}

.btn-lg {
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 5px;
}

</style>
<div class="container">
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="text-primary"><i class="fas fa-car"></i> Sell Your Cars as a Dealership</h2>
            <p class="text-muted">Easily list your cars and reach thousands of potential buyers, including private sellers.</p>
        </div>
    </div>

    <!-- Step-by-Step Guide -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                    <h5>Sign Up</h5>
                    <p>Create an account on our platform and unlock the ability to sell your cars. During signing up, under User Type, register as a dealer to access the car management tools.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-edit fa-3x text-success mb-3"></i>
                    <h5>Get Started</h5>
                    <p>Goto Account Icon on and select Manage Dealership. navigated to manage dealership you will see multiple options to manage your dealership </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-car-alt fa-3x text-danger mb-3"></i>
                    <h5>Add Your Vehicles</h5>
                    <p>Go to the car management section to add your cars' details, upload images, and set prices.  You can click on Vehicle Management and your be guided on how to add a car.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-ad fa-3x text-warning mb-3"></i>
                    <h5>Feature or Sponsor Your Cars</h5>
                    <p>Use the listing management tools to sponsor or feature your cars for better visibility.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-handshake fa-3x text-info mb-3"></i>
                    <h5>Reach Buyers and Sellers</h5>
                    <p>We share your cars with buyers and private sellers to ensure quick and effective lead generation.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-secondary mb-3"></i>
                    <h5>Track and Manage Sales</h5>
                    <p>Monitor your cars' sales performance and interact with interested buyers directly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="row mt-5">
        <div class="col text-center">
            <h4 class="text-dark"><i class="fas fa-gift"></i> Benefits of Selling as a Dealership</h4>
            <p class="text-muted">Explore the unique advantages we offer to dealerships.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6><i class="fas fa-bullhorn text-primary"></i> Maximum Exposure</h6>
                    <p>Your cars get listed on our platform and shared with potential buyers and private sellers.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6><i class="fas fa-users text-success"></i> Buyer Network</h6>
                    <p>We connect your cars with our network of buyers to accelerate the sale process.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6><i class="fas fa-edit text-warning"></i> Easy Management</h6>
                    <p>Manage your listings, track performance, and update details with ease.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col text-center">
            <a href="{{ route('signup') }}" class="btn btn-primary btn-lg"><i class="fas fa-sign-in-alt"></i> Get Started Now</a>
        </div>
    </div>
</div>
@endsection