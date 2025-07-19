<?php

echo "=== Testing All API Methods ===\n\n";

// Test 1: User Registration (POST)
echo "1. Testing POST /api/register\n";
$userData = json_encode([
    'name' => 'Method Test User',
    'email' => 'methodtest' . time() . '@example.com',
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

echo "   Response (HTTP $httpCode): " . (($httpCode == 201) ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";

// Test 2: Create Task (POST)
echo "2. Testing POST /api/tasks\n";
$taskData = json_encode([
    'title' => 'Test Task',
    'description' => 'This is a test task'
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

$taskId = json_decode($response)->id ?? null;
echo "   Response (HTTP $httpCode): " . (($httpCode == 201) ? "✅ SUCCESS" : "❌ FAILED") . " - Task ID: $taskId\n\n";

// Test 3: Get All Tasks (GET)
echo "3. Testing GET /api/tasks\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "   Response (HTTP $httpCode): " . (($httpCode == 200) ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";

// Test 4: Get Single Task (GET)
if ($taskId) {
    echo "4. Testing GET /api/tasks/$taskId\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/tasks/$taskId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "   Response (HTTP $httpCode): " . (($httpCode == 200) ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";
}

// Test 5: Update Task (PUT)
if ($taskId) {
    echo "5. Testing PUT /api/tasks/$taskId\n";
    $updateData = json_encode([
        'title' => 'Updated Test Task',
        'description' => 'This task has been updated',
        'is_completed' => true
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/tasks/$taskId");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $updateData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "   Response (HTTP $httpCode): " . (($httpCode == 200) ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";
}

// Test 6: Create Blog Post (POST)
echo "6. Testing POST /api/posts\n";
$postData = json_encode([
    'title' => 'Test Blog Post',
    'content' => 'This is test content for the blog post.'
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

$postId = json_decode($response)->id ?? null;
echo "   Response (HTTP $httpCode): " . (($httpCode == 201) ? "✅ SUCCESS" : "❌ FAILED") . " - Post ID: $postId\n\n";

// Test 7: Get All Posts (GET)
echo "7. Testing GET /api/posts\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/posts');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "   Response (HTTP $httpCode): " . (($httpCode == 200) ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";

echo "=== All Method Tests Complete! ===\n";
