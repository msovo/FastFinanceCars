<!-- resources/views/admin/categories/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="card mt-3">
    <div class="card-header">Edit Category</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category_type">Category Type</label>
                <input type="text" class="form-control" id="category_type" name="category_type" value="{{ $category->category_type }}" readonly>
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</div>
@endsection
