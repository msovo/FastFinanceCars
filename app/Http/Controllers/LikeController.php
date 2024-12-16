<?php
namespace App\Http\Controllers;


use App\Models\car_media_feed;
use App\Models\car_media_like;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
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
    
            return redirect()->back();
        }
}




