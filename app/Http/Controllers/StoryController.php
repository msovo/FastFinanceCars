<?php
namespace App\Http\Controllers;


use App\Models\car_media_feed;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;
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

        $path = $request->file('media')->store('media');

        car_media_story::create([
            'user_id' => auth()->id(),
            'media_path' => $path,
            'media_type' => $request->file('media')->getMimeType(),
            'caption' => $request->caption,
        ]);

        return redirect()->route('stories.index');
    }
}
