@extends('vendor.mail.html.layout')

@section('content')
<h2>Hello, {{ $user->username }}</h2>
<p>Welcome to Fast Finance Cars! Please verify your email address by clicking the button below:</p>
<a href="{{ $verificationUrl }}" class="button">Verify Email</a>
<p>If you did not create an account, no further action is required.</p>

<h2>Sponsored Cars</h2>
@foreach($sponsoredCars as $car)
    <div class="car-listing">
        <img src="{{ asset('storage/' . $car->image_url) }}" alt="{{ $car->model }}">

        <h3>{{ $car->make }} {{ $car->model }}</h3>
        <p>{{ $car->description }}</p>
        <a href="{{ route('cars.show', $car->vehicle_id) }}">View Listing</a>
    </div>
@endforeach

<h2>Latest News</h2>
@foreach($news as $newsItem)
    <div class="news-item">
    <img id="mainImageNews{{ $newsItem->news_id }}" src="{{ asset('storage/' . $newsItem->image_url) }}" alt="News Image" >
        <h3>{{ $newsItem->title }}</h3>
        <p>{{ Str::limit($newsItem->content, 150) }}</p>
        <a href="{{ route('news.show', $newsItem->news_id) }}" class="btn btn-primary">Read More</a>
        </div>
@endforeach

<p>Thank you,<br>Fast Finance Cars Team</p>
@endsection
