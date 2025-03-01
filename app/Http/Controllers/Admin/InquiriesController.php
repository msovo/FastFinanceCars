<?php

// app/Http/Controllers/Admin/InquiriesController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class InquiriesController extends Controller
{
    public function showByVehicle($vehicle_id)
    {
        $vehicle = Vehicle::with(['car_brand', 'car_model', 'listing.inquiries'])->findOrFail($vehicle_id);

        if (!$vehicle->listing) {
            return redirect()->route('admin.vehicles.index')->with('error', 'This vehicle has no listings.');
        }

        $inquiries = $vehicle->listing->inquiries;

        return view('admin.inquiries.index', compact('vehicle', 'inquiries'));
    }
}