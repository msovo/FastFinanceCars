@extends('layouts.index')

@section('content')
<style>

.main-image-container {
    position: relative;
}

.thumbnails {
    overflow-x: auto;
    white-space: nowrap;
}

.thumbnail-image {
    display: inline-block;
    margin-right: 5px;
    max-width: 100px; /* Adjust the size as needed */
    max-height: 100px; /* Adjust the size as needed */
}
.thumbnail-image {
        display: flex;
        overflow-x: auto;
        margin-top: 10px;
    }
    .thumbnail-image  img {
        width: 100%;
        max-height: 150px;
        cursor: pointer;
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
</style>
<div class="container">
<h1>{{ $news->title }}</h1>
<div class="row">
    <!-- Main Image Slider -->
    <div class="col-md-8">
        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if($news->thumbnail_url)
                <div class="carousel-item active">
                    <img id="mainImage" src="{{ asset('storage/' . $news->thumbnail_url) }}" class="d-block w-100" alt="Main Image" style="height: 50vh; object-fit: cover;">
                </div>
                @endif
                @foreach($news->images as $image)
                @if($image->image_url)
                <div class="carousel-item">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="News Image" style="height: 50vh; object-fit: cover;">
                </div>
                @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Thumbnails -->
        <div class="carousel-thumbnails mt-2">
            <div class="row">
                @if($news->thumbnail_url)
                <div class="col">
                    <img src="{{ asset('storage/' . $news->thumbnail_url) }}" class="img-thumbnail related-image" alt="Thumbnail" style="height: 12.5vh; object-fit: cover; cursor: pointer;" data-target="#newsCarousel" data-slide-to="0">
                </div>
                @endif
                @foreach($news->images as $index => $image)
                @if($image->image_url)
                <div class="col">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail related-image" alt="Thumbnail" style="height: 12.5vh; object-fit: cover; cursor: pointer;" data-target="#newsCarousel" data-slide-to="{{ $index + 1 }}">
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- News Metadata -->
    <div class="col-md-4">
        <div class="news-metadata mt-4">
            <p><strong>Author:</strong> {{ $news->author->username }}</p>
            <p><strong>Category:</strong> {{ $news->category }}</p>
            <p><strong>Updated At:</strong> {{ $news->updated_at}}</p>
            <p><strong>Average Rating:</strong> {{ number_format($averageRating, 1) }} / 5</p>
        </div>
    </div>
</div>
<!-- News Content -->
<div class="row mt-4">
    <div class="col-12">
        <div class="news-content">
            <p>{{ $news->content }}</p>
        </div>
    </div>
</div>

    <!-- Sponsored Vehicles -->
    <div class="row mt-4">
    <div class="col-12">
        <h2>Sponsored Vehicles</h2>
        <div class="row">
            @foreach($sponsoredVehicles->take(3) as $vehicle)
                <div class="col-md-4 mb-4">
                    <div class="card" onclick="location.href='{{ route('cars.show', $vehicle->vehicle_id) }}';" style="cursor: pointer;">
                        @if($vehicle->images->isNotEmpty())
                            <div class="main-image-container">
                                <img src="{{ asset('storage/' . $vehicle->images->first()->image_url) }}" class="d-block w-100 main-image" alt="Sponsored Vehicle Image">
                                <span class="position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 20px; left: 0;">
                                    <i class="fas fa-camera"></i> {{ $vehicle->images->count() }}
                                </span>
                            </div>
                        @else
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="d-block w-100 main-image" alt="Default Image">
                            </div>
                        @endif
                        <div class="row thumbnails mt-2">
                            @foreach($vehicle->images as $image)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail thumbnail-image" alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-car"></i> {{ $vehicle->make }} {{ $vehicle->model }}
                            </h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt"></i> {{ $vehicle->year }}   
                                <i class="fas fa-road"></i> {{ $vehicle->mileage }} km   
                                <i class="fas fa-money-bill-wave"></i> R{{ number_format($vehicle->price, 2) }}  
                            </p>
                            <p class="card-text text-danger">
                                R{{ number_format(calculateMonthlyPayment($vehicle->price), 2) }} p/m 
                                <span class="badge" style="background-color: {{ $vehicle->car_condition == 'Used' ? 'red' : 'blue' }};">
                                    {{ ucfirst($vehicle->car_condition) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


    <!-- Related News -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Related News</h2>
            <div class="row">
                @foreach($relatedNews as $newsItem)
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 100%;">
                        <img src="{{ asset('storage/' . $newsItem->images->first()->image_url) }}" class="d-block w-100" alt="Related News Image" style="height: 30vh; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $newsItem->title }}</h5>
                            <p class="card-text">{{ Str::limit($newsItem->content, 150) }}</p>
                            <a href="{{ route('news.show', $newsItem->news_id) }}" class="btn btn-primary">Read More</a>
                            <p><strong>Author:</strong> {{ $newsItem->author->name }}</p>
                            <p><strong>Category:</strong> {{ $newsItem->category }}</p>
                            <p><strong>Published At:</strong> {{ $newsItem->published_at }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Ad Placeholders -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="google-ad" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/728x90?text=Ad" alt="Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>

    <!-- User Comments and Ratings -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Comments and Ratings</h2>
            <form action="{{ route('news.comment', ['news' => $news->news_id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Leave a Comment:</label>
                    <textarea class="form-control" id="comment" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <form action="{{ route('news.rate', ['news' => $news->news_id]) }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="rating">Rate this Article:</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="comments mt-4">
                <h3>Comments</h3>
                @foreach($comments as $comment)
                <div class="comment mb-2">
                    <p><strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Polls -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Poll</h2>
            @if($poll)
            <form action="{{ route('poll.vote', ['pollOption' => $poll->options->first()->id]) }}" method="POST">
                @csrf
                <p>{{ $poll->question }}</p>
                @foreach($poll->options as $option)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="poll_option_id" id="option{{ $option->id }}" value="{{ $option->id }}">
                    <label class="form-check-label" for="option{{ $option->id }}">
                        {{ $option->option }}
                    </label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-2">Vote</button>
            </form>
            @else
            <p>No active polls at the moment.</p>
            @endif
        </div>
    </div>

    <!-- Social Media Sharing    <!-- Social Media Sharing Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Share this Article</h2>
            <div class="social-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" class="btn btn-primary" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" class="btn btn-info" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" class="btn btn-primary" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <a href="mailto:?subject=I wanted to share this article with you&body={{ urlencode(request()->fullUrl()) }}" class="btn btn-secondary" target="_blank"><i class="fas fa-envelope"></i> Email</a>
            </div>
        </div>
    </div>
</div>

<script>

</script>
@endsection
<?php
function calculateMonthlyPayment($price) {
    $interestRate = 0.15; // 15% annual interest rate
    $financeFeeRate = 0.10; // 15% finance fees and services
    $loanTermYears = 5.9; // Loan term in years

    // Add finance fees to the price
    $totalPrice = $price * (1 + $financeFeeRate);

    // Calculate monthly interest rate
    $monthlyInterestRate = $interestRate / 12;

    // Calculate number of payments
    $numPayments = $loanTermYears * 12;

    // Calculate monthly payment using the formula for an installment loan
    $monthlyPayment = ($totalPrice * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numPayments));

    return round($monthlyPayment, 2);
}
?>