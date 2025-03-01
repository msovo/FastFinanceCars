<?php
namespace App\Http\Controllers;

use App\Models\car_media_like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        Log::debug('Store method called', ['request' => $request->all()]);
       
        $validatedData = $request->validate([
            'description' => 'required|string|max:50',
            'car_media_feed_id' => 'nullable|exists:car_media_feeds,id',
            'car_media_story_id' => 'nullable|exists:car_media_stories,id',
        ]);
        Log::debug('Validation passed', ['validatedData' => $validatedData]);
    
        // Check if a like already exists for the user and the given car_media_feed_id
        $existingLike = car_media_like::where('user_id', auth()->id())
            ->where('car_media_feed_id', $request->car_media_feed_id)
            ->first();
    
        if ($existingLike) {
            // Delete the existing like
            $existingLike->delete();
            Log::debug('Existing like deleted', ['existingLike' => $existingLike]);
        } else {
            // Update or create a new like
            $like = car_media_like::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'car_media_feed_id' => $request->car_media_feed_id,
                ],
                ['description' => $request->description]
            );
            Log::debug('Like updated or created', ['like' => $like]);
        }
    
        $reactionCounts = car_media_like::where('car_media_feed_id', $request->car_media_feed_id)
            ->select('description', \DB::raw('count(*) as count'))
            ->groupBy('description')
            ->get();
        Log::debug('Reaction counts retrieved', ['reactionCounts' => $reactionCounts]);
    
        return response()->json(data: $reactionCounts);
    }

    public function getReactions($feedId)
    {
        $reactionCounts = car_media_like::where('car_media_feed_id', $feedId)
            ->select('description', \DB::raw('count(*) as count'))
            ->groupBy('description')
            ->get();

        return response()->json($reactionCounts);
    }
}