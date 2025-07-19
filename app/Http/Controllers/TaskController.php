<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Create a new task
     * 
     * Task 3: Task Management API - Add task endpoint
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);
        
        return response()->json($task, 201);
    }

    /**
     * Update task completion status
     * 
     * Task 3: Task Management API - Mark task as completed endpoint
     */
    public function update($id, Request $request)
    {
        $task = Task::find($id);
        
        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $request->validate([
            'is_completed' => 'required|boolean',
        ]);

        $task->update([
            'is_completed' => $request->is_completed,
        ]);
        
        return response()->json($task->fresh());
    }

    /**
     * Get all pending tasks
     * 
     * Task 3: Task Management API - Get pending tasks endpoint
     */
    public function pending()
    {
        $tasks = Task::where('is_completed', false)->get();
        return response()->json($tasks);
    }
}
