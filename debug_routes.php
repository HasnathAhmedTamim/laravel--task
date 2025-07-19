<?php

echo "=== Debugging API Route Issue ===\n\n";

// Test 1: Check root URL (should return API documentation)
echo "1. Testing GET / (root URL)\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): ";
echo (strpos($response, 'Laravel API Server is Running') !== false) ? "✅ Correct API documentation" : "❌ Unexpected response";
echo "\n\n";

// Test 2: Check POST /api/register (should register user)
echo "2. Testing POST /api/register (user registration)\n";
$userData = json_encode([
    'name' => 'Debug User',
    'email' => 'debug' . time() . '@example.com',
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

echo "Response (HTTP $httpCode):\n";
$responseData = json_decode($response, true);

if ($httpCode == 201 && isset($responseData['id'])) {
    echo "✅ SUCCESS: User registration working correctly\n";
    echo "User ID: " . $responseData['id'] . "\n";
    echo "Name: " . $responseData['name'] . "\n";
    echo "Email: " . $responseData['email'] . "\n";
} else if (isset($responseData['message']) && $responseData['message'] == 'Laravel API Server is Running!') {
    echo "❌ PROBLEM: Getting API documentation instead of user registration\n";
    echo "This means you're hitting the wrong endpoint or using wrong method\n";
} else {
    echo "❌ UNEXPECTED RESPONSE:\n";
    echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n";
}

echo "\n\n";

// Test 3: Check if GET /api/register gives proper error
echo "3. Testing GET /api/register (should give 405 Method Not Allowed)\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): ";
if ($httpCode == 405) {
    echo "✅ Correct - GET method not allowed for registration\n";
} else {
    echo "❌ Unexpected - Should be 405 Method Not Allowed\n";
}

echo "\n=== Debugging Complete ===\n";
echo "\nCONCLUSION:\n";
echo "- Root URL (/) should return API documentation\n";
echo "- POST /api/register should register user\n";
echo "- GET /api/register should return 405 error\n";
