<?php

echo "=== Testing User Registration Validation ===\n\n";

// Test with missing required fields
echo "Test: POST /api/register (Missing password)\n";
echo "Body: { \"name\": \"Test User\", \"email\": \"test@example.com\" }\n\n";

$userData = json_encode([
    'name' => 'Test User',
    'email' => 'test@example.com'
    // Missing password
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

echo "=== Validation Test Complete ===\n";
