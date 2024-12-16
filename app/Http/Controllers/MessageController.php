<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarMediaMessage;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'message_type' => 'required|in:story,feed,general',
            'car_media_feed_id' => 'nullable|exists:car_media_feeds,id',
            'car_media_story_id' => 'nullable|exists:car_media_stories,id',
        ]);

        $validated['sender_id'] = auth()->id();

        // Create the message
        CarMediaMessage::create($validated);

        return response()->json(['message' => 'Message sent successfully.']);
    }

    public function index()
    {
        $messages = CarMediaMessage::with(['sender', 'receiver', 'feed', 'story'])
            ->where('receiver_id', auth()->id())
            ->get();

        return view('messages.index', compact('messages'));
    }
}
