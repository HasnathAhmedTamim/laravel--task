<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Laravel API Server is Running!',
        'version' => '1.0.0',
        'endpoints' => [
            'User Registration' => 'POST /api/register',
            'Blog Posts' => [
                'Create' => 'POST /api/posts',
                'Get All' => 'GET /api/posts',
                'Get Single' => 'GET /api/posts/{id}',
                'Update' => 'PUT /api/posts/{id}',
                'Delete' => 'DELETE /api/posts/{id}'
            ],
            'Tasks' => [
                'Create' => 'POST /api/tasks',
                'Get All' => 'GET /api/tasks',
                'Get Single' => 'GET /api/tasks/{id}',
                'Update' => 'PUT /api/tasks/{id}',
                'Delete' => 'DELETE /api/tasks/{id}'
            ]
        ],
        'documentation' => 'See README.md for detailed API usage'
    ]);
});
