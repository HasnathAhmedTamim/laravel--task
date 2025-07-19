<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * AuthController handles user authentication operations
 * 
 * This controller manages user registration and authentication
 * processes for the API endpoints.
 */
class AuthController extends Controller
{
    /**
     * Register a new user
     * 
     * Validates user input, hashes the password, creates a new user
     * record in the database, and returns the user information.
     * 
     * @param Request $request The HTTP request containing user data
     * @return \Illuminate\Http\JsonResponse JSON response with user data or validation errors
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|min:3',                    // Name must be at least 3 characters
            'email' => 'required|email|unique:users,email', // Email must be valid and unique
            'password' => 'required|min:8',                // Password must be at least 8 characters
        ]);

        // Hash the password for secure storage
        $validated['password'] = Hash::make($validated['password']);
        
        // Create the new user in the database
        $user = User::create($validated);
        
        // Return the user data (excluding password) with 201 Created status
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ], 201);
    }
}
