@extends('layouts.index')

@section('content')
<style>
    .content-section {
        width: 70%;
        margin-left: 15%;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }
    .content-section h2 {
        color: #343a40;
    }
    .content-section p {
        color: #6c757d;
    }
    .content-section img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .feature-list {
        list-style-type: none;
        padding: 0;
    }
    .feature-list li {
        margin-bottom: 10px;
    }
    .feature-list li::before {
        content: "✔️";
        margin-right: 10px;
        color: #28a745;
    }
</style>

<div class="content-section">
    <h2>Welcome to Our Dealership Management System</h2>
    <p>Our platform offers a comprehensive suite of tools and services designed to help dealerships and private sellers manage their inventory, sales, and customer interactions efficiently.</p>
    
    <h3>Key Features</h3>
    <ul class="feature-list">
        <li>Inventory Management: Easily manage your vehicle listings and keep track of stock levels.</li>
        <li>Sales Tracking: Monitor your sales performance with detailed analysis reports.</li>
        <li>Lead Management: Handle customer inquiries and leads directly through our platform.</li>
        <li>Customer Communication: Communicate with customers via the app or other preferred methods.</li>
        <li>Comprehensive Insights: Gain valuable insights into your business operations with our advanced analytics.</li>
    </ul>

    <p>Our system is designed to be user-friendly and efficient, making it easier for you to focus on growing your business. With more features coming soon, we are committed to providing you with the best tools to succeed in the automotive market.</p>

    <a href="{{ route('dealer.dashboard') }}" class="btn btn-primary">Manage Your Dealership</a>
</div>
@endsection