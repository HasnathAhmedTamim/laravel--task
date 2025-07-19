<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return response()->json([
        'message' => 'Laravel API Server is Running!',
        'version' => '1.0.0',
        'endpoints' => [
            'User Registration' => 'POST /api/register',
            'Blog Posts' => 'GET|POST /api/posts',
            'Tasks' => 'GET|POST|PUT /api/tasks'
        ]
    ]);
});

// =============================================================================
// API ROUTES WITH API MIDDLEWARE (No CSRF protection)
// =============================================================================
Route::prefix('api')->middleware('api')->group(function () {
    
    // TASK 1: BLOG POST CRUD API
    Route::post('/posts', [BlogPostController::class, 'store']);
    Route::get('/posts', [BlogPostController::class, 'index']);
    Route::get('/posts/{id}', [BlogPostController::class, 'show']);

    // TASK 2: USER REGISTRATION API  
    Route::post('/register', function (Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            ]);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    });
    
    // Debug route for user registration
    Route::post('/register-test', function () {
        return response()->json(['message' => 'Registration route reached!']);
    });

    // TASK 3: TASK MANAGEMENT API
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::get('/tasks/pending', [TaskController::class, 'pending']);

    // Test routes
    Route::get('/test-direct', function () {
        return response()->json(['message' => 'Direct API test working!']);
    });
});

// Test routes
Route::get('/test-web-api', function () {
    return response()->json(['message' => 'Web API test working!']);
});
