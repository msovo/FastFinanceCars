<?php
// app/Http/Controllers/Admin/ServiceProviderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class ServiceProviderController extends Controller
{
    public function index()
    {
        $serviceProviders = ServiceProvider::all();
        return view('admin.serviceproviders.index', compact('serviceProviders'));
    }

    public function create()
    {
        return view('admin.serviceproviders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'provider_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        ServiceProvider::create($request->all());

        return redirect()->route('admin.serviceproviders.index')->with('success', 'Service Provider created successfully.');
    }

    public function edit(ServiceProvider $serviceProvider)
    {
        return view('admin.serviceproviders.edit', compact('serviceProvider'));
    }

    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        $request->validate([
            'provider_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $serviceProvider->update($request->all());

        return redirect()->route('admin.serviceproviders.index')->with('success', 'Service Provider updated successfully.');
    }

    public function destroy(ServiceProvider $serviceProvider)
    {
        $serviceProvider->delete();
        return redirect()->route('admin.serviceproviders.index')->with('success', 'Service Provider deleted successfully.');
    }
}
