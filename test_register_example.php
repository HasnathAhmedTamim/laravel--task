<?php

echo "=== Testing User Registration Example ===\n\n";

// Example: POST /api/register
echo "Example: POST /api/register\n";
echo "Body: { \"name\": \"Jane Doe\", \"email\": \"jane@example.com\", \"password\": \"password123\" }\n\n";

$userData = json_encode([
    'name' => 'Jane Doe',
    'email' => 'jane' . time() . '@example.com', // Make email unique
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
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "=== Registration Test Complete ===\n";
