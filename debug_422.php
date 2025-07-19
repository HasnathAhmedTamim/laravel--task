<?php

echo "=== Debugging 422 Validation Error ===\n\n";

// Test with verbose error details
$userData = json_encode([
    'name' => 'Jane Doe',
    'email' => 'jane' . time() . '@example.com',
    'password' => 'password123'
]);

echo "Testing with data: $userData\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response:\n";
echo json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\n\n";

if ($httpCode == 422) {
    $errorData = json_decode($response, true);
    echo "🔍 VALIDATION ERRORS DETECTED:\n";
    if (isset($errorData['errors'])) {
        foreach ($errorData['errors'] as $field => $messages) {
            echo "- $field: " . implode(', ', $messages) . "\n";
        }
    }
    echo "\n📝 SOLUTION:\n";
    echo "Fix the validation errors above in your Postman request.\n";
} elseif ($httpCode == 201) {
    echo "✅ SUCCESS: Registration worked perfectly!\n";
} else {
    echo "❓ Unexpected response code: $httpCode\n";
}

echo "\n=== Debug Complete ===\n";
