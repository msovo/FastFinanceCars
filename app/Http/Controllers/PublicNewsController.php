<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Listing;
use App\Models\Comments;
use App\Models\Rating;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use App\Models\User;

class PublicNewsController extends Controller
{
    public function home()
    {
        $news = News::orderBy('published_at', 'desc')->take(3)->get();
        return view('home', compact('news'));
    }

    public function index()
    {
        $news = News::with(['author', 'images'])->get();
        $categories = NewsCategory::all();

        $latestFeaturedVehicles = Listing::where('featured', 1)
                                         ->where('listing_status', 'active')
                                         ->latest()
                                         ->take(3)
                                         ->with(['vehicle', 'images'])
                                         ->get();

        $sponsoredVehicles = Listing::where('sponsored', 1)
                                    ->where('listing_status', 'active')
                                    ->latest()
                                    ->take(3)
                                    ->with(['vehicle', 'images'])
                                    ->get();

        return view('public.news.index', compact('news', 'categories', 'latestFeaturedVehicles', 'sponsoredVehicles'));
    }

    public function show(News $news)
    {
        $news->load('images', 'author');
    
        $sponsoredVehicles = Listing::where('sponsored', 1)
                                    ->where('listing_status', 'active')
                                    ->latest()
                                    ->take(5)
                                    ->with(['vehicle', 'images'])
                                    ->get();
    
        $relatedNews = News::where('category', $news->category)
                           ->where('news_id', '!=', $news->news_id)
                           ->latest('updated_at')
                           ->take(5)
                           ->with(['author', 'images'])
                           ->get();
    
        $comments = Comments::where('news_id', $news->news_id)
                            ->with('user:user_id,username') // Ensure the user relationship is loaded with the correct keys
                            ->get();
    
  
    
        $averageRating = Rating::where('news_id', $news->news_id)->avg('rating');
        $poll = Poll::with('options')->latest()->first();
    
        return view('public.news.show', compact('news', 'sponsoredVehicles', 'relatedNews', 'comments', 'averageRating', 'poll'));
    }
    
    

    public function storeComment(Request $request, News $news)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'content' => 'required|string',
        ]);

        Comments::create([
            'news_id' => $news->news_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back();
    }

    public function storeRating(Request $request, News $news)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::create([
            'news_id' => $news->news_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return back();
    }

    public function storePollVote(Request $request, PollOption $pollOption)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        PollVote::create([
            'poll_option_id' => $pollOption->id,
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}
