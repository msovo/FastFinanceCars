<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Inquiry request data: ', $request->all());
    
        // Set up validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'listing_id' => 'required|integer|exists:listings,listing_id',
        ];
    
        // Add user_id validation rule if the user is logged in
        if (Auth::check()) {
            $rules['user_id'] = 'required|integer|exists:users,user_id';
        }
    
        // Validate the request data
        $request->validate($rules);
    
        try {
            // Create a new inquiry
            Inquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'listing_id' => $request->listing_id,
                'user_id' => Auth::check() ? $request->user_id : null, // Set user_id if logged in
            ]);
    
            // Log success message
            Log::info('Inquiry created successfully for listing_id: ' . $request->listing_id);
    
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating inquiry: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was an error submitting your inquiry. Please try again.');
        }
    }
    public function approve(Request $request, $id)
{
    $lead = Inquiry::findOrFail($id);
    $lead->status = 1;
    $lead->dealer_message = $request->message;
    $lead->save();

    return response()->json(['success' => true]);
}

public function decline(Request $request, $id)
{
    $lead = Inquiry::findOrFail($id);
    $lead->status = -1;
    $lead->dealer_message = $request->message;
    $lead->save();

    return response()->json(['success' => true]);
}

}

