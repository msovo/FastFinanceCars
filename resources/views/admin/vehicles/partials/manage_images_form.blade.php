<!-- resources/views/admin/vehicles/partials/manage_images_form.blade.php -->

<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Manage Vehicle Images</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.vehicles.updateImages', $vehicle->vehicle_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Existing Images -->
            <div class="form-group">
                <label>Existing Images</label>
                <div class="row">
                    @foreach ($vehicle->images as $image)
                        <div class="col-md-2 text-center">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail mb-2">
                            <form action="{{ route('admin.vehicles.deleteImage', $image->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Add New Images -->
            <div class="form-group">
                <label for="images">Add New Images</label>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                <div id="imagePreview" class="mt-2"></div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Upload Images</button>
        </form>
    </div>
</div>