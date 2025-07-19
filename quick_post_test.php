<?php

echo "=== Quick POST Method Test ===\n\n";

echo "Testing with POST method (should work):\n";
$userData = json_encode([
    'name' => 'Test User',
    'email' => 'test' . time() . '@example.com',
    'password' => 'password123'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);  // This is POST method
curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "POST Request Result:\n";
echo "HTTP Code: $httpCode\n";
echo "Response: " . json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

if ($httpCode == 201) {
    echo "✅ SUCCESS! POST method works perfectly!\n";
} else {
    echo "❌ Something went wrong with POST\n";
}

echo "\n=== COMPARISON ===\n";
echo "❌ GET /api/register  → 405 Method Not Allowed\n";
echo "✅ POST /api/register → 201 Created (Success)\n\n";

echo "SOLUTION: Change method from GET to POST in Postman!\n";
