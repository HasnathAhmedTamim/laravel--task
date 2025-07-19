<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Create a new blog post
     * 
     * Task 1: Blog Post CRUD API - Create endpoint
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        
        return response()->json($post, 201);
    }

    /**
     * List all blog posts
     * 
     * Task 1: Blog Post CRUD API - Read all endpoint
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * View a single blog post
     * 
     * Task 1: Blog Post CRUD API - Read single endpoint
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }
        
        return response()->json($post);
    }
}
