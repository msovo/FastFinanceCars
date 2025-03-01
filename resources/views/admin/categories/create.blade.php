<!-- resources/views/admin/categories/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New Category')

@section('content')
<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-plus"></i> Add New Category</h4>
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

            <!-- Category Creation Form -->
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <!-- Category Type -->
                <div class="form-group">
                    <label for="category_type"><strong>Category Type</strong></label>
                    <select class="form-control" id="category_type" name="category_type" onchange="toggleCustomCategoryTypeInput()">
                        <option value="">-- Select Category Type --</option>
                        @foreach ($categoryTypes as $type)
                            <option value="{{ $type->category_type }}">{{ $type->category_type }}</option>
                        @endforeach
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" class="form-control mt-2" id="custom_category_type" name="custom_category_type" placeholder="Enter custom category type" style="display:none;">
                </div>

                <!-- Category Name -->
                <div class="form-group">
                    <label for="category_name"><strong>Category Name</strong></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>

                <!-- Form Actions -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Add Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Categories
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Script -->
@section('scripts')
<script>
    function toggleCustomCategoryTypeInput() {
        const categoryTypeSelect = document.getElementById('category_type');
        const customCategoryTypeInput = document.getElementById('custom_category_type');
        if (categoryTypeSelect.value === 'Other') {
            customCategoryTypeInput.style.display = 'block';
            customCategoryTypeInput.required = true;
        } else {
            customCategoryTypeInput.style.display = 'none';
            customCategoryTypeInput.required = false;
        }
    }
</script>
@endsection
@endsection