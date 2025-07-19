<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * TaskController handles task management operations
 * 
 * This controller provides API endpoints for creating tasks,
 * updating task completion status, and retrieving pending tasks.
 */
class TaskController extends Controller
{
    /**
     * Create a new task
     * 
     * Validates the task title and creates a new task record.
     * Tasks are created with is_completed set to false by default.
     * 
     * @param Request $request The HTTP request containing task data
     * @return \Illuminate\Http\JsonResponse JSON response with created task data
     */
    public function store(Request $request)
    {
        // Validate the incoming request - title is required
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        // Create the new task (is_completed defaults to false)
        $task = Task::create($validated);
        
        // Return the created task with 201 Created status
        return response()->json($task, 201);
    }

    /**
     * Get all tasks
     * 
     * @return \Illuminate\Http\JsonResponse JSON response with all tasks
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Get a single task by ID
     * 
     * @param int $id The ID of the task to retrieve
     * @return \Illuminate\Http\JsonResponse JSON response with task data
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update a task
     * 
     * @param Request $request The HTTP request containing update data
     * @param int $id The ID of the task to update
     * @return \Illuminate\Http\JsonResponse JSON response with updated task data
     */
    public function update(Request $request, $id)
    {
        // Find the task or fail with 404 if not found
        $task = Task::findOrFail($id);
        
        // Validate the request data
        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'is_completed' => 'sometimes|required|boolean'
        ]);
        
        // Update the task with validated data
        $task->update($validated);
        
        // Return the updated task data
        return response()->json($task);
    }

    /**
     * Delete a task
     * 
     * @param int $id The ID of the task to delete
     * @return \Illuminate\Http\JsonResponse JSON response confirming deletion
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        
        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
     * Get all pending (incomplete) tasks
     * 
     * Retrieves all tasks where is_completed is false.
     * Useful for displaying a todo list or pending work items.
     * 
     * @return \Illuminate\Http\JsonResponse JSON response with array of pending tasks
     */
    public function pending()
    {
        // Query for all tasks that are not completed
        $pendingTasks = Task::where('is_completed', false)->get();
        
        // Return the collection of pending tasks
        return response()->json($pendingTasks);
    }
}
