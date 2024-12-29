<?php
namespace App\Http\Controllers;


use App\Models\car_media_comment;
use App\Models\car_media_feed;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CarMediaCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'car_media_feed_id' => 'nullable|exists:car_media_feeds,id',
            'car_media_story_id' => 'nullable|exists:car_media_stories,id',
        ]);
    
      $comment=  car_media_comment::create([
            'user_id' => auth()->id(),
            'car_media_feed_id' => $request->feed_id,
            'car_media_story_id' => $request->car_media_story_id,
            'comment' => $request->comment,
            'description' => $request->car_media_feed_id ? 'feed' : 'story',
        ]);

     

        return response()->json([
            'user' => [
                'username' => Auth::user()->username,
                'profile_image' => Auth::user()->profile_image,
                'id' => Auth::id(),
            ],
            'comment' => $request->comment,
            'feed_id' => $request->feed_id,
            'time' =>  $comment->created_at->diffForHumans(),
        ]);  
      }   



      public function getCommentCount($feedId)
      {
          $count = car_media_comment::where('car_media_feed_id', $feedId)->count();
          return response()->json(['count' => $count]);
      }
      public function getNewComments($feedId, Request $request)
      {
          $lastFetchedId = $request->input('last_fetched_id');
          
          $newComments = car_media_comment::where('car_media_feed_id', $feedId)
              ->where('id', '>', $lastFetchedId)
              ->with('user')
              ->get();
        
          foreach ($newComments as $comment) {
              $comment->time = $comment->created_at->diffForHumans();
          }
          return response()->json($newComments);
      }      
      
}