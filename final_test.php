<?php

echo "=== Comprehensive Registration Test ===\n\n";

function testRegistrationEndpoint($data, $testName) {
    echo "Testing: $testName\n";
    echo "Data: " . json_encode($data) . "\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    $headers = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);

    echo "HTTP Code: $httpCode\n";
    echo "Response Body:\n";
    
    $responseData = json_decode($body, true);
    if ($responseData) {
        echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n";
        
        // Check what type of response we got
        if (isset($responseData['message']) && $responseData['message'] === 'Laravel API Server is Running!') {
            echo "❌ PROBLEM: Getting API documentation instead of registration response!\n";
            echo "This suggests the request is not reaching the registration endpoint.\n";
        } elseif (isset($responseData['id'])) {
            echo "✅ SUCCESS: User registration successful!\n";
        } elseif (isset($responseData['errors'])) {
            echo "⚠️  VALIDATION ERRORS: " . json_encode($responseData['errors']) . "\n";
        } else {
            echo "❓ UNEXPECTED RESPONSE TYPE\n";
        }
    } else {
        echo "Raw response: " . $body . "\n";
    }
    
    echo "\n" . str_repeat("-", 50) . "\n\n";
}

// Test 1: Valid registration
testRegistrationEndpoint([
    'name' => 'Test User',
    'email' => 'test' . time() . '@example.com',
    'password' => 'password123'
], 'Valid Registration');

// Test 2: Missing required fields
testRegistrationEndpoint([
    'name' => 'Test User'
    // Missing email and password
], 'Missing Required Fields');

// Test 3: Invalid data
testRegistrationEndpoint([
    'name' => 'Jo', // Too short
    'email' => 'invalid-email',
    'password' => '123' // Too short
], 'Invalid Data');

// Test 4: Check if the issue is with Content-Type
echo "Testing without Content-Type header:\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'name' => 'No Content Type',
    'email' => 'nocontenttype' . time() . '@example.com',
    'password' => 'password123'
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: " . $response . "\n\n";

echo "=== Test Complete ===\n";
