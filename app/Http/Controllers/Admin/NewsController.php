<?php
// app/Http/Controllers/Admin/NewsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Log;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {

        $news = News::with(['author', 'categories'])->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

  

public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
        ]);

        Log::info('Validation passed', $request->all());

        $news = new News($request->except('thumbnail_url'));
        $news->author_id = Auth::id(); // Set the author to the currently authenticated user

        if ($request->hasFile('thumbnail_url')) {
            $path = $request->file('thumbnail_url')->store('thumbnails', 'public');
            $news->thumbnail_url = $path;
            Log::info('Thumbnail uploaded', ['path' => $path]);
        }

        $news->save();
        Log::info('News saved', ['news' => $news]);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    } catch (\Exception $e) {
        Log::error('Error saving news', ['error' => $e->getMessage()]);
        return redirect()->route('admin.news.index')->with('error', 'Failed to create news.');
    }
}

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news->fill($request->except('thumbnail_url'));

        if ($request->hasFile('thumbnail_url')) {
            // Delete the old thumbnail if it exists
            if ($news->thumbnail_url) {
                Storage::disk('public')->delete($news->thumbnail_url);
            }

            $path = $request->file('thumbnail_url')->store('thumbnails', 'public');
            $news->thumbnail_url = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        // Delete the thumbnail if it exists
        if ($news->thumbnail_url) {
            Storage::disk('public')->delete($news->thumbnail_url);
        }

        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }

    public function addImage(Request $request, News $news)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('news_images', 'public');

        $newsImage = new NewsImage();
        $newsImage->news_id = $news->news_id;
        $newsImage->image_url = $path;
        $newsImage->caption = $request->input('caption', '');
        $newsImage->save();

        return redirect()->route('admin.news.edit', $news->news_id)->with('success', 'Image added successfully.');
    }
}
