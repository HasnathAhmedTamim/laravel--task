<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * BlogPostController handles blog post management operations
 * 
 * This controller provides full CRUD (Create, Read, Update, Delete)
 * functionality for blog posts through API endpoints.
 */
class BlogPostController extends Controller
{
    /**
     * Create a new blog post
     * 
     * Validates the post data and creates a new blog post record.
     * Both title and content are required fields.
     * 
     * @param Request $request The HTTP request containing post data
     * @return \Illuminate\Http\JsonResponse JSON response with created post data
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string',   // Post title is required
            'content' => 'required|string', // Post content is required
        ]);
        
        // Create the new blog post
        $post = Post::create($validated);
        
        // Return the created post with 201 Created status
        return response()->json($post, 201);
    }

    /**
     * Get all blog posts
     * 
     * Retrieves and returns all blog posts from the database.
     * 
     * @return \Illuminate\Http\JsonResponse JSON response with array of all posts
     */
    public function index()
    {
        // Get all posts and return as JSON
        return response()->json(Post::all());
    }

    /**
     * Get a specific blog post by ID
     * 
     * Finds and returns a single blog post by its ID.
     * Returns 404 if the post is not found.
     * 
     * @param int $id The ID of the post to retrieve
     * @return \Illuminate\Http\JsonResponse JSON response with post data
     */
    public function show($id)
    {
        // Find the post or fail with 404 if not found
        $post = Post::findOrFail($id);
        
        // Return the post data
        return response()->json($post);
    }

    /**
     * Update an existing blog post
     * 
     * Validates the updated data and modifies the specified blog post.
     * Both title and content are required for updates.
     * 
     * @param Request $request The HTTP request containing updated post data
     * @param int $id The ID of the post to update
     * @return \Illuminate\Http\JsonResponse JSON response with updated post data
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string',   // Updated title is required
            'content' => 'required|string', // Updated content is required
        ]);
        
        // Find the post or fail with 404 if not found
        $post = Post::findOrFail($id);
        
        // Update the post with validated data
        $post->update($validated);
        
        // Return the updated post data
        return response()->json($post);
    }

    /**
     * Delete a blog post
     * 
     * Permanently removes a blog post from the database.
     * Returns a success message upon completion.
     * 
     * @param int $id The ID of the post to delete
     * @return \Illuminate\Http\JsonResponse JSON response with success message
     */
    public function destroy($id)
    {
        // Find the post or fail with 404 if not found
        $post = Post::findOrFail($id);
        
        // Delete the post from the database
        $post->delete();
        
        // Return success message
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
