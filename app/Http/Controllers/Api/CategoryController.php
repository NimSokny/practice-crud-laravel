<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET
    public function index(Request $request)
    {
        $categories = Category::latest()->get();

        if (! $request->is('api/*')) {
            return view('categories.list', compact('categories'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Category List',
            'data' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    // POST
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $category = Category::create($data);

        if (! $request->is('api/*')) {
            return redirect()
                ->route('categories.index')
                ->with('success', 'Category created successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Category Created',
            'data' => $category
        ], 201);
    }

    // GET BY ID
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // PUT
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $category->update($data);

        if (! $request->is('api/*')) {
            return redirect()
                ->route('categories.index')
                ->with('success', 'Category updated successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Category Updated',
            'data' => $category
        ]);
    }

    // DELETE
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        if (! $request->is('api/*')) {
            return redirect()
                ->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Category Deleted'
        ]);
    }
}
