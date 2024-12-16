<?php
namespace App\Http\Controllers;


use App\Models\car_media_comment;
use App\Models\car_media_feed;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;

class CarMediaCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'car_media_feed_id' => 'nullable|exists:car_media_feeds,id',
            'car_media_story_id' => 'nullable|exists:car_media_stories,id',
        ]);
    
        car_media_comment::create([
            'user_id' => auth()->id(),
            'car_media_feed_id' => $request->car_media_feed_id,
            'car_media_story_id' => $request->car_media_story_id,
            'comment' => $request->comment,
            'description' => $request->car_media_feed_id ? 'feed' : 'story',
        ]);
    
        return redirect()->back();
    }
}