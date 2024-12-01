@extends('layouts.index')

@section('content')
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.02);
    }

    
    .imgCard{
        height: 250px;
        overflow: hidden;
    }

</style>

<div class="container py-4">
    <h1 class="text-dark">
        {{ $selectedCategory ? "Articles in $selectedCategory->category_name" : 'All Articles' }}
    </h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Search Form -->
        <form action="{{ route('newssearch') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search news..." />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-3">
        <!-- Category and Sort Form -->
        <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
            <label for="category" class="me-2">Category:</label>
            <select name="category" id="category" class="form-select me-3" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <label for="sort" class="me-2">Sort by:</label>
            <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
            </select>
        </form>
    </div>

    @if($news->isNotEmpty())
        <div class="row">
            @foreach($news as $item)
                <div class="col-md-4 mb-4" onclick="location.href='{{ route('news.show', $item->news_id) }}';">
                    <div class="card h-100 shadow">
                       <div class="imgCard">
                        <img src="{{ asset('storage/' . $item->thumbnail_url) }}" class="card-img-top" alt="{{ $item->title }}">
                    </div> 
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit($item->content, 100) }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            By {{ $item->author->username }} | {{ $item->published_at }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $news->withQueryString()->links() }}
        </div>
    @else
        <div class="alert alert-info">No news found matching your search criteria.</div>
    @endif
</div>
@endsection
