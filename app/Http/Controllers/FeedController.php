<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\car_media_feed;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class FeedController extends Controller
{
    public function index()
    {
        $feeds = car_media_feed::with(relations: ['user', 'comments', 'likes'])->orderBy('id', 'desc')->get();
        $stories =car_media_story::with(['user', 'comments', 'likes'])->orderBy('id', 'desc')->get();
        return view('feeds.index', compact('feeds','stories'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called.');
        $request->validate([
            'media.*' => 'required|file|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);
    

        
        Log::info('Validation passed.');
    
        $mediaPaths = [];
        foreach ($request->file('media') as $file) {
            // Convert to WebP
            Log::info('Processing file: ' . $file->getClientOriginalName());
    
            $image = Image::make($file)->encode('webp', 90);
            $path = 'media/' . uniqid() . '.webp';
            Storage::disk('public')->put($path, $image);
    
            Log::info('File converted and stored at: ' . $path);
    
            $mediaPaths[] = [
                'user_id' => auth()->id(),
                'media_path' => $path,
                'media_type' => 'image/webp',
                'caption' => $request->caption,
            ];
        }
    
        Log::info('All files processed.');
    
        car_media_feed::insert($mediaPaths);
    
        Log::info('Media paths inserted into database.');
    
        if ($request->ajax()) {
            Log::info('AJAX request detected.');
            $feeds = car_media_feed::orderBy('id', 'desc')->get();
            Log::info('Feeds retrieved from database.');
            return view('partials._feeds', compact('feeds'));
        }
    
        Log::info('Non-AJAX request, redirecting to feeds index.');
        return redirect()->route('feeds.index');
    }
}