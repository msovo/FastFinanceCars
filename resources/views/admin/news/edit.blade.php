<!-- resources/views/admin/news/edit.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit News</h1>
    <button id="addImageButton" class="btn btn-secondary mb-3">Add Images</button>
    <form id="editNewsForm" action="{{ route('admin.news.update', $news->news_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required>{{ $news->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->category_id }}" {{ $news->category == $category->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="thumbnail_url">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail_url" name="thumbnail_url">
            @if($news->thumbnail_url)
                <img src="{{ asset('storage/' . $news->thumbnail_url) }}" alt="Thumbnail" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Image Upload Form -->
    <form id="addImageForm" action="{{ route('admin.news.addImage', $news->news_id) }}" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload Image</button>
        <button type="button" id="cancelImageButton" class="btn btn-secondary">Cancel</button>
    </form>

    <!-- Existing Images Slider -->
    @if($news->images->count() > 0)
    <div id="newsImagesCarousel" class="carousel slide mt-4" data-ride="carousel" style="height: 50vh;">
        <div class="carousel-inner" style="height: 100%;">
            @foreach($news->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 100%;">
                <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="Image" style="max-height: 100%; object-fit: contain;">
                <div class="carousel-caption d-none d-md-block">
                    <p>{{ $image->caption }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#newsImagesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#newsImagesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Thumbnails -->
    <div class="row mt-4">
        @foreach($news->images as $index => $image)
        <div class="col-2">
            <a href="#newsImagesCarousel" data-slide-to="{{ $index }}">
                <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail" alt="Image">
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script>
document.getElementById('addImageButton').addEventListener('click', function() {
    document.getElementById('editNewsForm').style.display = 'none';
    document.getElementById('addImageForm').style.display = 'block';
});

document.getElementById('cancelImageButton').addEventListener('click', function() {
    document.getElementById('addImageForm').style.display = 'none';
    document.getElementById('editNewsForm').style.display = 'block';
});
</script>
@endsection
