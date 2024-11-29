<!-- resources/views/admin/news/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add New News</h1>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="thumbnail_url">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail_url" name="thumbnail_url">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
