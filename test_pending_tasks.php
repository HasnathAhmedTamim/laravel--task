<?php

echo "=== Testing Pending Tasks Fix ===\n\n";

// First, let's make sure we have some tasks with different completion status
echo "1. Creating test tasks...\n";

// Create a pending task
$pendingTask = json_encode([
    'title' => 'Pending Task',
    'description' => 'This task is not completed'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $pendingTask);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$taskData = json_decode($response);
$taskId = $taskData->id ?? null;

echo "Created pending task (HTTP $httpCode): ID $taskId\n";

// Create a completed task
$completedTask = json_encode([
    'title' => 'Completed Task',
    'description' => 'This task will be marked as completed'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $completedTask);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$taskData2 = json_decode($response);
$taskId2 = $taskData2->id ?? null;

// Mark the second task as completed
if ($taskId2) {
    $updateData = json_encode(['is_completed' => true]);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api/tasks/$taskId2");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $updateData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    
    echo "Marked task $taskId2 as completed\n\n";
}

echo "2. Testing GET /api/tasks/pending\n";
echo "cURL command: curl -X GET http://127.0.0.1:8000/api/tasks/pending\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/tasks/pending');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Response (HTTP $httpCode):\n";

if ($httpCode == 200) {
    $pendingTasks = json_decode($response);
    echo "✅ SUCCESS - Found " . count($pendingTasks) . " pending tasks\n";
    echo json_encode($pendingTasks, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "❌ FAILED - HTTP $httpCode\n";
    echo $response . "\n";
}

echo "\n=== Pending Tasks Test Complete ===\n";
