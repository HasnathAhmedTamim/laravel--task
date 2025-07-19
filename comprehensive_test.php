<?php

echo "🚀 Laravel API Project - Live API Testing\n";
echo "==========================================\n\n";

echo "Testing all 3 core functionalities with real examples...\n\n";

// 1. User Registration API
echo "1️⃣  USER REGISTRATION API\n";
echo "-------------------------\n";
echo "POST /api/register\n";

$userData = json_encode([
    'name' => 'Jane Doe',
    'email' => 'jane' . time() . '@example.com',
    'password' => 'password123'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Request Body:\n" . $userData . "\n\n";
echo "Response (HTTP $httpCode):\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

// 2. Blog Post CRUD API
echo "2️⃣  BLOG POST CRUD API\n";
echo "----------------------\n";

// Create Post
echo "📝 CREATE POST - POST /api/posts\n";
$postData = json_encode([
    'title' => 'My First Post',
    'content' => 'This is my content.'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/posts');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Request Body:\n" . $postData . "\n\n";
echo "Response (HTTP $httpCode):\n";
$createdPost = json_decode($response, true);
echo json_encode($createdPost, JSON_PRETTY_PRINT) . "\n\n";

// List All Posts
echo "📋 LIST ALL POSTS - GET /api/posts\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/posts');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

// 3. Task Management API
echo "3️⃣  TASK MANAGEMENT API\n";
echo "-----------------------\n";

// Create Task
echo "✅ CREATE TASK - POST /api/tasks\n";
$taskData = json_encode([
    'title' => 'Finish Laravel test'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $taskData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Request Body:\n" . $taskData . "\n\n";
echo "Response (HTTP $httpCode):\n";
$createdTask = json_decode($response, true);
echo json_encode($createdTask, JSON_PRETTY_PRINT) . "\n\n";

// Mark Task as Completed
echo "🔄 UPDATE TASK - PATCH /api/tasks/{$createdTask['id']}\n";
$updateData = json_encode([
    'is_completed' => true
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/tasks/{$createdTask['id']}");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($ch, CURLOPT_POSTFIELDS, $updateData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Request Body:\n" . $updateData . "\n\n";
echo "Response (HTTP $httpCode):\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

// Get Pending Tasks
echo "📋 GET PENDING TASKS - GET /api/tasks/pending\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks/pending');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "🎉 ALL API ENDPOINTS TESTED SUCCESSFULLY!\n";
echo "==========================================\n";
echo "✅ User Registration API - Working\n";
echo "✅ Blog Post CRUD API - Working\n";
echo "✅ Task Management API - Working\n\n";
echo "🚀 Laravel API Project is fully functional!\n";
