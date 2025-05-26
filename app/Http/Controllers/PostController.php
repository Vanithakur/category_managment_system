<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Exception;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('category')->latest()->get();
            return view('posts.index', compact('posts'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load posts. ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            return view('posts.create', compact('categories'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form. ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:100',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:published,draft',
                'thumbnail' => 'nullable|image|max:2048',
            ]);

            $validated['slug'] = Str::slug($validated['title']);

            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('posts', 'public');
                $validated['thumbnail'] = $path;
            }

            Post::create($validated);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create post. ' . $e->getMessage());
        }
    }

    public function show(Post $post)
    {
        try {
            return view('posts.show', compact('post'));
        } catch (Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to show post. ' . $e->getMessage());
        }
    }

    public function edit(Post $post)
    {
        try {
            $categories = Category::all();
            return view('posts.edit', compact('post', 'categories'));
        } catch (Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to load edit form. ' . $e->getMessage());
        }
    }

    public function update(Request $request, Post $post)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:100',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:published,draft',
                'thumbnail' => 'nullable|image|max:2048',
            ]);

            $validated['slug'] = Str::slug($validated['title']);

            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('posts', 'public');
                $validated['thumbnail'] = $path;
            }

            $post->update($validated);

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update post. ' . $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to delete post. ' . $e->getMessage());
        }
    }
}
