<!-- resources/views/admin/categories/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New Category')

@section('content')
<div class="card mt-3">
    <div class="card-header">Add New Category</div>
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
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_type">Category Type</label>
                <select class="form-control" id="category_type" name="category_type" onchange="toggleCustomCategoryTypeInput()">
                    <option value="">Select Category Type</option>
                    @foreach ($categoryTypes as $type)
                        <option value="{{ $type->category_type }}">{{ $type->category_type }}</option>
                    @endforeach
                    <option value="Other">Other</option>
                </select>
                <input type="text" class="form-control mt-2" id="custom_category_type" name="custom_category_type" placeholder="Enter custom category type" style="display:none;">
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</div>

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
