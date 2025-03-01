<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\car_media_feed;
use App\Models\car_media_story;
use App\Models\car_media_reply;
use App\Models\MediaAccessibility;
use App\Models\PostFeature;
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
        
        $feeds = car_media_feed::with(['user', 'images'])
        ->withCount('comments') // Adds comments_count
        ->withCount(['likes as total_likes' => function($query) {
            $query->select(DB::raw('count(*)'));
        }])     ->orderBy('id', 'desc')
        ->get()
        ->map(function ($feed) {
            $feed->is_liked_by_user = $feed->isLikedByUser;
            return $feed;
        });

        $stories =car_media_story::with(['user','likes'])->orderBy('id', 'desc')->get();
        return view('feeds.index', compact('feeds','stories'));
    }
    public function store(Request $request)
    {
        Log::info('Store method called.');
        
        $request->validate([
            'media.*' => 'required|file|max:10240',
            'caption' => 'nullable|string|max:2200',
            'post_type' => 'required|in:regular,sale,offer,clearance',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'is_negotiable' => 'boolean',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'allow_comments' => 'boolean',
            'show_views' => 'boolean',
            'allow_sharing' => 'boolean',
            'alt_text' => 'nullable|string',
        ]);
    
        DB::beginTransaction();
        
        try {
            // Create the feed
            $feed = car_media_feed::create([
                'user_id' => auth()->id(),
                'caption' => $request->caption,
                'post_type' => $request->post_type,
                'price' => $request->price,
                'location' => $request->location,
                'is_negotiable' => $request->boolean('is_negotiable'),
                'is_featured' => $request->boolean('is_featured'),
                'is_urgent' => $request->boolean('is_urgent'),
                'allow_comments' => $request->boolean('allow_comments', true),
                'show_views' => $request->boolean('show_views', true),
                'allow_sharing' => $request->boolean('allow_sharing', true),
            ]);
    
            // Handle media files
            $mediaPaths = [];
            foreach ($request->file('media') as $index => $file) {
                if ($file->getMimeType() === 'video/mp4') {
                    // Handle video
                    $path = $file->store('media/videos', 'public');
                    $mediaType = 'video/mp4';
                } else {
                    // Handle image - convert to WebP
                    $image = Image::make($file)->encode('webp', 90);
                    $path = 'media/' . uniqid() . '.webp';
                    Storage::disk('public')->put($path, $image);
                    $mediaType = 'image/webp';
                }
    
                // Create media record
                $feedImage = FeedImage::create([
                    'car_media_feed_id' => $feed->id,
                    'media_path' => $path,
                    'media_type' => $mediaType,
                ]);
    
                // Create accessibility record if alt text is provided
                if ($request->has('alt_text')) {
                    MediaAccessibility::create([
                        'feed_image_id' => $feedImage->id,
                        'alt_text' => $request->alt_text,
                    ]);
                }
            }
    
            // Store features if any
            if ($request->has('features')) {
                foreach ($request->features as $feature) {
                    PostFeature::create([
                        'feed_id' => $feed->id,
                        'feature_type' => $feature,
                        'value' => null // Add any specific feature values if needed
                    ]);
                }
            }
    
            DB::commit();
    
            if ($request->ajax()) {
                $feeds = car_media_feed::with(['images', 'features'])
                                    ->orderBy('id', 'desc')
                                    ->get();
                return view('partials._feeds', compact('feeds'));
            }
    
            return redirect()->route('feeds.index')->with('success', 'Post created successfully!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Feed creation failed: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to create post'], 500);
            }
            
            return back()->with('error', 'Failed to create post. Please try again.');
        }
    }

    public function toggleCommentLike(car_media_comment $comment)
{
    $user = auth()->user();
    Log::debug('User attempting to toggle like', ['user_id' => auth()->id(), 'comment_id' => $comment->id]);

    $liked = $comment->likes()->where('user_id', auth()->id())->exists();
    Log::debug('Like status', ['liked' => $liked]);

    if ($liked) {
        $comment->likes()->where('user_id', auth()->id())->delete();
        $action = 'unliked';
        Log::debug('Like deleted', ['user_id' => auth()->id(), 'comment_id' => $comment->id]);
    } else {
        $comment->likes()->create(['user_id' =>auth()->id()]);
        $action = 'liked';
        Log::debug('Like created', ['user_id' => auth()->id(), 'comment_id' => $comment->id]);
    }

    $likesCount = $comment->likes()->count();
    Log::debug('Total likes count', ['likes_count' => $likesCount]);

    return response()->json([
        'success' => true,
        'action' => $action,
        'likes_count' => $likesCount
    ]);
}
  
}