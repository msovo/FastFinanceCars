<?php

// app/Http/Controllers/Admin/ReviewController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        Review::create($request->all());

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'listing_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        $review->update($request->all());

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
