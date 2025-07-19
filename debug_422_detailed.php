<?php

echo "=== 422 ERROR TROUBLESHOOTING ===\n\n";

// Test different scenarios that could cause 422 errors

$baseUrl = 'http://localhost:8000/api/register';

// Test Case 1: Missing required fields
echo "🔍 Test 1: Missing required fields\n";
$testData1 = [
    'name' => 'Test User'
    // Missing email and password
];

$response1 = makeApiCall($baseUrl, $testData1);
echo "Result: " . $response1['status'] . " - " . $response1['body'] . "\n\n";

// Test Case 2: Invalid email format
echo "🔍 Test 2: Invalid email format\n";
$testData2 = [
    'name' => 'Test User',
    'email' => 'invalid-email',
    'password' => 'password123'
];

$response2 = makeApiCall($baseUrl, $testData2);
echo "Result: " . $response2['status'] . " - " . $response2['body'] . "\n\n";

// Test Case 3: Short password
echo "🔍 Test 3: Password too short\n";
$testData3 = [
    'name' => 'Test User',
    'email' => 'test' . time() . '@example.com',
    'password' => '123' // Too short
];

$response3 = makeApiCall($baseUrl, $testData3);
echo "Result: " . $response3['status'] . " - " . $response3['body'] . "\n\n";

// Test Case 4: Short name
echo "🔍 Test 4: Name too short\n";
$testData4 = [
    'name' => 'AB', // Too short
    'email' => 'test' . time() . '@example.com',
    'password' => 'password123'
];

$response4 = makeApiCall($baseUrl, $testData4);
echo "Result: " . $response4['status'] . " - " . $response4['body'] . "\n\n";

// Test Case 5: Duplicate email (using existing email)
echo "🔍 Test 5: Duplicate email\n";
$testData5 = [
    'name' => 'Test User',
    'email' => 'john@example.com', // Known existing email
    'password' => 'password123'
];

$response5 = makeApiCall($baseUrl, $testData5);
echo "Result: " . $response5['status'] . " - " . $response5['body'] . "\n\n";

// Test Case 6: Valid request (should work)
echo "🔍 Test 6: Valid request\n";
$testData6 = [
    'name' => 'Valid User',
    'email' => 'valid' . time() . '@example.com',
    'password' => 'password123'
];

$response6 = makeApiCall($baseUrl, $testData6);
echo "Result: " . $response6['status'] . " - " . $response6['body'] . "\n\n";

echo "=== TROUBLESHOOTING COMPLETE ===\n";
echo "💡 Common 422 causes:\n";
echo "   - Missing required fields (name, email, password)\n";
echo "   - Invalid email format\n";
echo "   - Password less than 8 characters\n";
echo "   - Name less than 3 characters\n";
echo "   - Email already exists in database\n";
echo "   - Incorrect Content-Type header\n\n";

function makeApiCall($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'body' => $response
    ];
}
