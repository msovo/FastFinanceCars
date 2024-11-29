<?php
// app/Http/Controllers/Admin/ToolController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::all();
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tool_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'tool_type' => 'required|string',
            'url' => 'nullable|string|max:255',
        ]);

        Tool::create($request->all());

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'tool_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'tool_type' => 'required|string',
            'url' => 'nullable|string|max:255',
        ]);

        $tool->update($request->all());

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }
}
