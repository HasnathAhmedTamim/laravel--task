<?php

echo "=== Testing Blog Post CRUD API ===\n\n";

// Example 1: POST /api/posts - Create a Post
echo "Example 1: POST /api/posts\n";
echo "Body: { \"title\": \"My First Post\", \"content\": \"This is my content.\" }\n\n";

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

echo "Response (HTTP $httpCode):\n";
$responseData = json_decode($response);
echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n\n";

$postId = $responseData->id ?? null;

echo "-----------------------------------\n\n";

// Example 2: GET /api/posts - List All Posts
echo "Example 2: GET /api/posts\n";
echo "Expected: Array of all posts\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/posts');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "-----------------------------------\n\n";

// Example 3: GET /api/posts/{id} - View Single Post
if ($postId) {
    echo "Example 3: GET /api/posts/$postId\n";
    echo "Expected: Single post data\n\n";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/posts/$postId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "Response (HTTP $httpCode):\n";
    echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";
}

echo "=== Blog Post CRUD API Testing Complete ===\n";
