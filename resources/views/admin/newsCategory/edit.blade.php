<!-- resources/views/admin/newsCategory/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit News Category')

@section('content')
<div class="container-fluid mt-5">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">
                <i class="fas fa-edit"></i> Edit News Category
            </h4>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>
                        <i class="fas fa-exclamation-triangle"></i> There were some problems with your input:
                    </h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Category Edit Form -->
            <form action="{{ route('admin.newsCategory.update', $newsCategory->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_name"><strong>Category Name <span class="text-danger">*</span></strong></label>
                    <input type="text" 
                           class="form-control @error('category_name') is-invalid @enderror" 
                           id="category_name" 
                           name="category_name" 
                           value="{{ old('category_name', $newsCategory->category_name) }}" 
                           required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.newsCategory.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Back to Categories
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection