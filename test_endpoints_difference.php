<?php

echo "=== Demonstrating Correct vs Incorrect Endpoints ===\n\n";

// 1. Root URL (/) - Returns API documentation
echo "1. GET / (Root URL - API Documentation)\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): API Documentation\n";
echo substr($response, 0, 100) . "...\n\n";

echo "-----------------------------------\n\n";

// 2. Correct Registration Endpoint
echo "2. POST /api/register (Correct User Registration)\n";
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

echo "Response (HTTP $httpCode): User Registration Success\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "=== Make sure you're using POST /api/register, not GET / ===\n";
