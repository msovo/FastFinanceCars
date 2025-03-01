<!-- resources/views/admin/categories/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Category</h4>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> There were some problems with your input:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Category Edit Form -->
            <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Category Type (Read-only) -->
                <div class="form-group">
                    <label for="category_type"><strong>Category Type</strong></label>
                    <input type="text" class="form-control" id="category_type" name="category_type" value="{{ $category->category_type }}" readonly>
                </div>

                <!-- Category Name -->
                <div class="form-group">
                    <label for="category_name"><strong>Category Name</strong></label>
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
                    @error('category_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Categories
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection