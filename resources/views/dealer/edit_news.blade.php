@extends('layouts.dealer')

@section('content')
    <div class="container">
        <h1>Edit News: {{ $newsItem->title }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row"> 
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header">
                        Edit News Details
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dealer.news.update', $newsItem->news_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $newsItem->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" required>{{ $newsItem->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_name }}" {{ $newsItem->category == $category->category_name ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_url">Thumbnail</label>
                                <input type="file" class="form-control-file" id="thumbnail_url" name="thumbnail_url">
                            </div>

                            <button type="submit" class="btn btn-primary">Update News</button>
                        </form>
                    </div>
                </div>
            </div> 

            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header">
                        Add Poll
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dealer.news.poll.add', $newsItem->news_id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" required>
                            </div>
                            <div class="form-group">
                                <label for="options">Options (one per line)</label>
                                <textarea class="form-control" id="options" name="options" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Poll</button>
                        </form>
                    </div>
                </div>
            </div> 
        </div> 

        <div class="row mt-4"> 
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Comment
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dealer.news.comment.add', $newsItem->news_id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Comment</label>
                                <textarea class="form-control" id="content" name="content" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Images
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dealer.news.images.add', $newsItem->news_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="images">Select Images</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Images</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Existing Comments
                    </div>
                    <div class="card-body">
                        @if ($newsItem->comments->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($newsItem->comments as $comment)
                                    <li class="list-group-item">{{ $comment->user->username }} : {{ $comment->content }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No comments added yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4"> 
            <div class="card-header">
                Existing Images
            </div>
            <div class="card-body">
                @if ($newsItem->images->isNotEmpty())
                    <div class="row">
                        @foreach ($newsItem->images as $image)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $image->image_url) }}" alt="News Image" class="img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No images added yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection