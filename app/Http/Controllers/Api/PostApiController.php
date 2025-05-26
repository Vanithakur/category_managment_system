<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;

class PostApiController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::where('status', 'published')
                         ->latest()
                         ->take(5)
                         ->with('category')
                         ->get()
                         ->map(function ($post) {
                             return [
                                 'title' => $post->title,
                                 'slug' => $post->slug,
                                 'status' => $post->status,
                                 'category' => $post->category->title,
                                 'thumbnail_url' => $post->thumbnail ? asset('storage/' . $post->thumbnail) : null,
                                 'created_at' => $post->created_at->toDateTimeString(),
                             ];
                         });

            return response()->json([
                'success' => true,
                'data' => $posts
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching posts.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
