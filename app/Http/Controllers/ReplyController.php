<?php 
namespace App\Http\Controllers;


use App\Models\car_media_comment;
use App\Models\car_media_feed;
use App\Models\car_media_like;
use App\Models\car_media_reply;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ReplyController extends Controller
{
    public function store(Request $request, car_media_comment $comment)
    {
        Log::debug('Store method called', ['request' => $request->all(), 'comment_id' => $comment->id]);
    
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);
    
        $reply = car_media_reply::create([
            'user_id' => auth()->id(),
            'car_media_comment_id' => $comment->id,
            'reply' => $request->reply,
        ]);
    
        $reply->load('user');
        Log::debug('Reply created', ['reply' => $reply]);
    
        return response()->json([
            'success' => true,
            'reply' => [
                'id' => $reply->id,
                'reply' => $reply->reply,
                'user' => [
                    'id' => $reply->user->id,
                    'username' => $reply->user->username,
                    'profile_image' => $reply->user->profile_image,
                ],
                'created_at' => $reply->created_at,
                'likes_count' => 0,
            ]
        ]);
    }

    public function toggleReplyiesLike(car_media_reply $reply)
    {
        
        Log::debug('User attempting to toggle like on reply', ['user_id' => auth()->id(), 'reply_id' => $reply->id]);
    
        $liked = $reply->likes()->where('user_id', auth()->id())->exists();
        Log::debug('Like status', ['liked' => $liked]);
    
        if ($liked) {
            $reply->likes()->where('user_id', auth()->id())->delete();
            $action = 'unliked';
            Log::debug('Like deleted', ['user_id' => auth()->id(), 'reply_id' => $reply->id]);
        } else {
            $reply->likes()->create(['user_id' =>auth()->id()]);
            $action = 'liked';
            Log::debug('Like created', ['user_id' => auth()->id(), 'reply_id' => $reply->id]);
        }
    
        $likesCount = $reply->likes()->count();
        Log::debug('Total likes count', ['likes_count' => $likesCount]);
    
        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $likesCount
        ]);
    }
    public function fetchReplies(car_media_comment $comment)
    {
        Log::debug('Fetching replies for comment', ['comment_id' => $comment->id]);
    
        $replies = $comment->replies()->with('user')->get();
    
        return response()->json([
            'success' => true,
            'replies' => $replies->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'reply' => $reply->reply,
                    'user' => [
                        'id' => $reply->user->id,
                        'username' => $reply->user->username,
                        'profile_image' => $reply->user->profile_image,
                    ],
                    'created_at' => $reply->created_at,
                    'likes_count' => $reply->likes()->count(),
                    'is_liked_by_user' => $reply->likes()->where('user_id', auth()->id())->exists(),
                ];
            })
        ]);
    }
    
}