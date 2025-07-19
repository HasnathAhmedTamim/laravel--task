<?php

echo "=== Testing User Registration API (Task 2) ===\n\n";

// Test 1: Valid Registration - Your Example
echo "Test 1: POST /api/register (Valid Data)\n";
echo "Body: { \"name\": \"Jane Doe\", \"email\": \"jane@example.com\", \"password\": \"password123\" }\n\n";

$userData = json_encode([
    'name' => 'Jane Doe',
    'email' => 'jane' . time() . '@example.com', // Unique email
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

echo "-----------------------------------\n\n";

// Test 2: Validation - Name too short
echo "Test 2: POST /api/register (Name too short - should fail)\n";
echo "Body: { \"name\": \"Jo\", \"email\": \"jo@example.com\", \"password\": \"password123\" }\n\n";

$invalidData = json_encode([
    'name' => 'Jo', // Less than 3 characters
    'email' => 'jo' . time() . '@example.com',
    'password' => 'password123'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $invalidData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): ";
if ($httpCode == 422) {
    echo "✅ VALIDATION WORKING - Name length validation successful\n";
} else {
    echo "❌ Unexpected response\n";
}
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "-----------------------------------\n\n";

// Test 3: Validation - Password too short
echo "Test 3: POST /api/register (Password too short - should fail)\n";
echo "Body: { \"name\": \"Valid Name\", \"email\": \"valid@example.com\", \"password\": \"123\" }\n\n";

$invalidData2 = json_encode([
    'name' => 'Valid Name',
    'email' => 'valid' . time() . '@example.com',
    'password' => '123' // Less than 8 characters
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $invalidData2);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): ";
if ($httpCode == 422) {
    echo "✅ VALIDATION WORKING - Password length validation successful\n";
} else {
    echo "❌ Unexpected response\n";
}
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "-----------------------------------\n\n";

// Test 4: Validation - Invalid email format
echo "Test 4: POST /api/register (Invalid email format - should fail)\n";
echo "Body: { \"name\": \"Valid Name\", \"email\": \"invalid-email\", \"password\": \"password123\" }\n\n";

$invalidData3 = json_encode([
    'name' => 'Valid Name',
    'email' => 'invalid-email', // Invalid email format
    'password' => 'password123'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $invalidData3);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode): ";
if ($httpCode == 422) {
    echo "✅ VALIDATION WORKING - Email format validation successful\n";
} else {
    echo "❌ Unexpected response\n";
}
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

echo "=== User Registration API Testing Complete ===\n";
