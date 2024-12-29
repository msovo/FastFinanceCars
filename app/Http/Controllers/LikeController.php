<?php
namespace App\Http\Controllers;

use App\Models\car_media_like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:50',
            'car_media_feed_id' => 'nullable|exists:car_media_feeds,id',
            'car_media_story_id' => 'nullable|exists:car_media_stories,id',
        ]);

        car_media_like::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'car_media_feed_id' => $request->car_media_feed_id,
                'car_media_story_id' => $request->car_media_story_id,
            ],
            ['description' => $request->description]
        );

        $reactionCounts = car_media_like::where('car_media_feed_id', $request->car_media_feed_id)
            ->orWhere('car_media_story_id', $request->car_media_story_id)
            ->select('description', \DB::raw('count(*) as count'))
            ->groupBy('description')
            ->get();

        return response()->json($reactionCounts);
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