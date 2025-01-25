<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\car_media_feed;
use App\Models\car_media_story;
use App\Models\FeedImage;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\car_media_comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function index()
    {
        
        $feeds = car_media_feed::with(['user', 'likes', 'images'])
        ->withCount('comments') // Adds comments_count
        ->withCount(['likes as total_likes' => function($query) {
            $query->select(DB::raw('count(*)'));
        }])
        
        // Add other reaction counts as needed
        ->orderBy('id', 'desc')
        ->get();

        $stories =car_media_story::with(['user','likes'])->orderBy('id', 'desc')->get();
        return view('feeds.index', compact('feeds','stories'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called.');
        $request->validate([
            'media.*' => 'required|file|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);
    
        $feed = car_media_feed::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
        ]);
    
        $mediaPaths = [];
        foreach ($request->file('media') as $file) {
            // Convert to WebP
            $image = Image::make($file)->encode('webp', 90);
            $path = 'media/' . uniqid() . '.webp';
            Storage::disk('public')->put($path, $image);
    
            $mediaPaths[] = [
                'car_media_feed_id' => $feed->id,
                'media_path' => $path,
                'media_type' => 'image/webp',
            ];
        }
    
        FeedImage::insert($mediaPaths);
    
        if ($request->ajax()) {
            $feeds = car_media_feed::with(relations: 'images')->orderBy('id', 'desc')->get();
            return view('partials._feeds', compact('feeds'));
        }
    
        return redirect()->route('feeds.index');
    }
    public function toggleCommentLike(car_media_comment $comment)
    {
        $user = auth()->user();
        $liked = $comment->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $comment->likes()->where('user_id', $user->id)->delete();
            $action = 'unliked';
        } else {
            $comment->likes()->create(['user_id' => $user->id]);
            $action = 'liked';
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $comment->likes()->count()
        ]);
    }
    public function toggleReplyiesLike(car_media_reply $reply)
    {
        $user = auth()->user();
        $liked = $reply->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $reply->likes()->where('user_id', $user->id)->delete();
            $action = 'unliked';
        } else {
            $reply->likes()->create(['user_id' => $user->id]);
            $action = 'liked';
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $reply->likes()->count()
        ]);
    }
}