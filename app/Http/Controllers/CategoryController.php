<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::latest()->get();
            return view('categories.index', compact('categories'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load categories. ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $validated['slug'] = Str::slug($validated['title']);

            Category::create($validated);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create category. ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        try {
            return view('categories.edit', compact('category'));
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to load edit form. ' . $e->getMessage());
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $validated['slug'] = Str::slug($validated['title']);

            $category->update($validated);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update category. ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category. ' . $e->getMessage());
        }
    }
}
