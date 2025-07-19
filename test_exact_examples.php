<?php

// Test the exact examples provided in the user request

echo "Testing Task API with exact examples from user request...\n\n";

// Example 1: POST /api/tasks with "Finish Laravel test"
echo "=== Example 1: POST /api/tasks ===\n";
echo "Body: { \"title\": \"Finish Laravel test\" }\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'title' => 'Finish Laravel test'
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";
$responseData = json_decode($response, true);
echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n\n";

$taskId = $responseData['id'] ?? 1;

// Example 2: PATCH /api/tasks/1 with is_completed: true
echo "=== Example 2: PATCH /api/tasks/{$taskId} ===\n";
echo "Body: { \"is_completed\": true }\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/tasks/{$taskId}");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'is_completed' => true
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";
$responseData = json_decode($response, true);
echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n\n";

echo "=== Additional Test: GET /api/tasks/pending ===\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks/pending');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Pending Tasks Response (HTTP $httpCode):\n";
$responseData = json_decode($response, true);
echo json_encode($responseData, JSON_PRETTY_PRINT) . "\n\n";

echo "✅ Task API Examples Testing Complete!\n";
