<?php

echo "=== TESTING YOUR EXACT SCENARIO ===\n\n";

// Test 1: Your current request (should fail with 422)
echo "🔍 Test 1: Your current request (jane@example.com)\n";
$failingData = [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
    'password' => 'password123'
];

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'http://localhost:8000/api/register');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($failingData));
curl_setopt($ch1, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

$response1 = curl_exec($ch1);
$httpCode1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
curl_close($ch1);

echo "Status: {$httpCode1}\n";
echo "Response: {$response1}\n\n";

// Test 2: Modified email (should succeed with 201)
echo "🔍 Test 2: Modified unique email\n";
$workingData = [
    'name' => 'Jane Doe',
    'email' => 'jane.doe.2025@example.com',
    'password' => 'password123'
];

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, 'http://localhost:8000/api/register');
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($workingData));
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

$response2 = curl_exec($ch2);
$httpCode2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
curl_close($ch2);

echo "Status: {$httpCode2}\n";
echo "Response: {$response2}\n\n";

if ($httpCode2 == 201) {
    echo "✅ SUCCESS: The modified email works perfectly!\n";
    echo "💡 Use 'jane.doe.2025@example.com' in your Postman request\n";
} else {
    echo "❌ Unexpected error with modified email\n";
}

echo "\n=== SOLUTION ===\n";
echo "Change your Postman request body to:\n";
echo "{\n";
echo '    "name": "Jane Doe",'."\n";
echo '    "email": "jane.doe.2025@example.com",'."\n";
echo '    "password": "password123"'."\n";
echo "}\n";

echo "\n=== TEST COMPLETE ===\n";
