<?php
// 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use App\Models\News;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::all();
        return view('admin.newsCategory.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.newsCategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        NewsCategory::create($request->all());

        return redirect()->route('admin.newsCategory.index')->with('success', 'Category created successfully.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.newsCategory.edit', compact('newsCategory'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $newsCategory->update($request->all());

        return redirect()->route('admin.newsCategory.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();
        return redirect()->route('admin.newsCategory.index')->with('success', 'Category deleted successfully.');
    }

  
}
