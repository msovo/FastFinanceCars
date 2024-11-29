<?php

// app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categoryTypes = Category::select('category_type')->distinct()->get();
        return view('admin.categories.create', compact('categoryTypes'));
    }
// app/Http/Controllers/Admin/CategoryController.php
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'category_type' => 'required_without:custom_category_type|string|max:255',
        'custom_category_type' => 'required_without:category_type|nullable|string|max:255',
        'category_name' => 'required|string|max:255',
    ]);

    // Determine the category type
    $categoryType = $request->category_type !== 'Other' ? $request->category_type : $request->custom_category_type;

    // Log the selected category type
    \Log::info('Selected category type: ' . $categoryType);

    // Ensure categoryType is a string and not null
    if (is_null($categoryType) || !is_string($categoryType)) {
        \Log::error('Invalid category type: ' . var_export($categoryType, true));
        return redirect()->back()->withErrors(['category_type' => 'Invalid category type selected.']);
    }

    // Create the category
    try {
        Category::create([
            'category_type' => $categoryType,
            'category_name' => $request->category_name,
        ]);
        \Log::info('Category created successfully with type: ' . $categoryType);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    } catch (\Exception $e) {
        \Log::error('Failed to create category: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Failed to create category.']);
    }
}

  
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_type' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    
}
