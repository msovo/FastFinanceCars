<?php 
namespace App\Http\Controllers;


use App\Models\car_media_comment;
use App\Models\car_media_feed;
use App\Models\car_media_like;
use App\Models\car_media_reply;
use App\Models\car_media_story;
use Illuminate\Http\Request;
use App\Models\User;

class ReplyController extends Controller
{
    public function store(Request $request, car_media_comment $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        car_media_reply::create([
            'user_id' => auth()->id(),
            'car_media_comment_id' => $comment->id,
            'reply' => $request->reply,
        ]);

        return redirect()->route('feeds.index');
    }
}