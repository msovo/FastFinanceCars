@extends('layouts.index')

@section('content')
<style>
    body {
    background-color: gainsboro;
    }
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        height: 200px; /* Adjust the height as needed */
    }
    .main-image-container img {
        width: 100%;
        height: auto;
    }
    .card-body {
        flex: 1;
    }
    .thumbnails {
        margin-top: 10px;
    }
    .thumbnail-image {
        width: 100%;
        height: auto;
    }
    .image-count {
        position: absolute;
        bottom: 20px; /* Adjusted to be 20px from the bottom */
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        border-radius: 3px;
    }

    .card-img-top{
        height: 250px;
        overflow: hidden;
    }
</style>
<div class="container" style="background: linear-gradient(to right, #f8f9fa, #e9ecef); ">
    <!-- Latest Featured Vehicles Row -->
    <!-- Car Marketplace Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Explore the Car Marketplace</h2>
            <p>Welcome to our car marketplace, where you can find a wide range of vehicles to suit your needs and preferences. Whether you're looking for the latest models, budget-friendly options, or luxury cars, we have something for everyone. Browse through our extensive listings, compare features, and find the perfect car for you.</p>
            <p>Our marketplace is designed to provide you with a seamless and enjoyable experience. Use our advanced search and filter options to narrow down your choices, and take advantage of our detailed vehicle descriptions and high-quality images to make an informed decision. Happy car hunting!</p>
        </div>
    </div>
 <!-- Google Ads Column -->
 <div class="row mb-4">
        <div class="col-md-12">
            <h2>Sponsored Ads</h2>
            <div class="google-ad" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/728x90?text=Cars.co.za+Ad" alt="Cars.co.za Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4 ">
        <!-- Search Form -->
        <form action="{{ route('newssearch') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2 w-100" placeholder="Search news..." />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <h2>Latest Articles</h2>
@foreach($news as $categoryName => $articles)
    <div class="category-section mb-4">
        <div class="category-header p-2">
            <h5>{{ $categoryName }}</h5>
<form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
    <input type="hidden" name="category" value="{{ $articles->first()->category_id }}" />
    <button type="submit" class="btn btn-primary view-all-btn">View All {{ $categoryName }} Articles</button>
</form>

        </div>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4">
                    <a href="{{ route('news.show', parameters: $article->news_id) }}" class="card mb-3 text-decoration-none text-dark">
                        <div class="card-img-top">
                            @if($article->thumbnail_url)
                                <img src="{{ asset('storage/' . $article->thumbnail_url) }}" alt="Thumbnail" class="img-fluid">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            By {{ $article->author->username }} | {{ $article->published_at }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endforeach


</div>
    
@endsection
