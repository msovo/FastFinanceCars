<?php
namespace App\Http\Controllers;


use App\Models\car_media_feed;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        $stories = car_media_story::with('user')->get();
        return view('stories.index', compact('stories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);
    
        // Get the uploaded file
        $file = $request->file('media');
    
        // Create an image instance
        $image = Image::make($file);
    
        // Convert the image to WebP format
        $webpImage = $image->encode('webp');
    
        // Define the path to store the image
        $path = 'media/' . uniqid() . '.webp';
        Storage::disk('public')->put($path, $image);
    
        car_media_story::create([
            'user_id' => auth()->id(),
            'media_path' => $path,
            'media_type' => 'image/webp',
            'caption' => $request->caption,
        ]);
 
        $stories =car_media_story::orderBy('id', 'desc')->get();
        return view('partials._stories', compact('stories'));
    }
}
