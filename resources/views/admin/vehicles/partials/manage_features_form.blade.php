<!-- resources/views/admin/vehicles/partials/manage_features_form.blade.php -->

<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Manage Vehicle Features</h5>
    </div>
    <div class="card-body">
        <!-- Existing Features -->
        @if ($vehicle->features->isNotEmpty())
            <div class="form-group">
                <label>Existing Features</label>
                <ul class="list-group mb-3">
                    @foreach ($vehicle->features as $feature)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $feature->feature }}
                            <form action="{{ route('admin.vehicles.deleteFeature', $feature->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>No features added.</p>
        @endif
        <!-- Add New Features -->
        <form action="{{ route('admin.vehicles.addFeatures', $vehicle->vehicle_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="features">Add Features (separate by commas)</label>
                <textarea class="form-control" id="features" name="features" rows="2"></textarea>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Features</button>
        </form>
    </div>
</div>