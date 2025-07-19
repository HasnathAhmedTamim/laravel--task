<?php

echo "=== REAL-TIME EMAIL VERIFICATION TEST ===\n\n";

// Generate a unique email for testing
$timestamp = time();
$testEmail = "verify{$timestamp}@example.com";
$testData = [
    'name' => 'Verification Test User',
    'email' => $testEmail,
    'password' => 'password123'
];

echo "🔄 Testing registration with email: {$testEmail}\n\n";

// Test registration via API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/api/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "📊 API Response:\n";
echo "Status Code: {$httpCode}\n";
echo "Response Body: {$response}\n\n";

if ($httpCode == 201) {
    echo "✅ SUCCESS: User registered successfully!\n";
    
    // Now verify the email exists in database
    require_once __DIR__ . '/vendor/autoload.php';
    
    use Illuminate\Database\Capsule\Manager as Capsule;
    
    $capsule = new Capsule;
    $capsule->addConnection([
        'driver' => 'sqlite',
        'database' => __DIR__ . '/database/database.sqlite',
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
    $user = Capsule::table('users')->where('email', $testEmail)->first();
    
    if ($user) {
        echo "✅ VERIFIED: Email found in database!\n";
        echo "📋 User Details:\n";
        echo "   - ID: {$user->id}\n";
        echo "   - Name: {$user->name}\n";
        echo "   - Email: {$user->email}\n";
        echo "   - Created: {$user->created_at}\n";
    } else {
        echo "❌ ERROR: Email not found in database despite successful API response!\n";
    }
    
} else {
    echo "❌ FAILED: Registration failed\n";
    $errorData = json_decode($response, true);
    if (isset($errorData['errors'])) {
        echo "🚨 Validation Errors:\n";
        foreach ($errorData['errors'] as $field => $messages) {
            echo "   {$field}: " . implode(', ', $messages) . "\n";
        }
    }
}

echo "\n=== TEST COMPLETE ===\n";
