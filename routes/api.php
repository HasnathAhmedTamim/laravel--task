<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ==========================================
// Authentication Routes
// ==========================================
Route::post('/register', [AuthController::class, 'register']);

// ==========================================
// Blog Post Management Routes
// ==========================================
Route::get('/posts', [BlogPostController::class, 'index']);        // Get all posts
Route::post('/posts', [BlogPostController::class, 'store']);       // Create new post
Route::get('/posts/{id}', [BlogPostController::class, 'show']);    // Get single post
Route::put('/posts/{id}', [BlogPostController::class, 'update']);  // Update post
Route::delete('/posts/{id}', [BlogPostController::class, 'destroy']); // Delete post

// ==========================================
// Task Management Routes
// ==========================================
Route::post('/tasks', [TaskController::class, 'store']);           // Create new task
Route::patch('/tasks/{id}', [TaskController::class, 'update']);    // Update task completion
Route::get('/tasks/pending', [TaskController::class, 'pending']);  // Get pending tasks
