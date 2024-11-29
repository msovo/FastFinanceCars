<!-- resources/views/admin/newsCategory/edit.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('admin.newsCategory.update', $newsCategory->category_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $newsCategory->category_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
