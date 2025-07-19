<?php
// Test Laravel API endpoints
echo "Testing Laravel API Endpoints\n";
echo "============================\n\n";

// Test 1: GET /api/posts (should return empty array)
echo "1. Testing GET /api/posts\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/posts");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Status: $httpCode\n";
echo "Response: $response\n\n";

// Test 2: POST /api/posts (create a new post)
echo "2. Testing POST /api/posts\n";
$data = json_encode([
    'title' => 'Test Post',
    'content' => 'This is a test post content.'
]);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/posts");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Status: $httpCode\n";
echo "Response: $response\n\n";

// Test 3: GET /api/posts (should now return the created post)
echo "3. Testing GET /api/posts (after creation)\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/posts");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Status: $httpCode\n";
echo "Response: $response\n\n";

echo "Testing complete!\n";
