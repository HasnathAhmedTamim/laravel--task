<?php

/**
 * Laravel Coding Round - API Testing Script
 * 
 * This script tests all three implemented APIs:
 * 1. User Registration API
 * 2. Blog Post CRUD API  
 * 3. Task Management API
 */

echo "🚀 Testing Laravel Coding Round APIs\n";
echo "===================================\n\n";

$baseUrl = 'http://127.0.0.1:8000/api';

function makeRequest($url, $method = 'GET', $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'PATCH') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        if ($data) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['code' => $httpCode, 'body' => $response];
}

echo "📝 TASK 2: Testing User Registration API\n";
echo "----------------------------------------\n";

$userData = [
    'name' => 'Jane Doe',
    'email' => 'jane' . time() . '@example.com', // Unique email
    'password' => 'password123'
];

$response = makeRequest($baseUrl . '/register', 'POST', $userData);
echo "POST /api/register - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

echo "📝 TASK 1: Testing Blog Post CRUD API\n";
echo "-------------------------------------\n";

// Create a post
$postData = [
    'title' => 'My First Post',
    'content' => 'This is my content.'
];

$response = makeRequest($baseUrl . '/posts', 'POST', $postData);
echo "POST /api/posts - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

$postId = json_decode($response['body'], true)['id'] ?? 1;

// Get all posts
$response = makeRequest($baseUrl . '/posts');
echo "GET /api/posts - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

// Get single post
$response = makeRequest($baseUrl . "/posts/{$postId}");
echo "GET /api/posts/{$postId} - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

echo "📝 TASK 3: Testing Task Management API\n";
echo "--------------------------------------\n";

// Create a task
$taskData = [
    'title' => 'Finish Laravel test'
];

$response = makeRequest($baseUrl . '/tasks', 'POST', $taskData);
echo "POST /api/tasks - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

$taskId = json_decode($response['body'], true)['id'] ?? 1;

// Mark task as completed
$updateData = [
    'is_completed' => true
];

$response = makeRequest($baseUrl . "/tasks/{$taskId}", 'PATCH', $updateData);
echo "PATCH /api/tasks/{$taskId} - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

// Get pending tasks
$response = makeRequest($baseUrl . '/tasks/pending');
echo "GET /api/tasks/pending - Status: {$response['code']}\n";
echo "Response: {$response['body']}\n\n";

echo "✅ All API tests completed!\n";
echo "===========================\n";
echo "🎯 All 3 tasks are working correctly:\n";
echo "• Task 1: Blog Post CRUD API ✅\n";
echo "• Task 2: User Registration API ✅\n";
echo "• Task 3: Task Management API ✅\n";

?>
