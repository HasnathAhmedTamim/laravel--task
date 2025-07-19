<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "=== USER EMAIL VERIFICATION ===\n\n";

try {
    // Get all users to see what emails exist
    $users = Capsule::table('users')->select('id', 'name', 'email', 'created_at')->get();
    
    if ($users->isEmpty()) {
        echo "❌ No users found in the database.\n";
    } else {
        echo "✅ Found " . $users->count() . " user(s) in the database:\n\n";
        
        foreach ($users as $user) {
            echo "ID: {$user->id}\n";
            echo "Name: {$user->name}\n";
            echo "Email: {$user->email}\n";
            echo "Created: {$user->created_at}\n";
            echo "----------------------------\n";
        }
    }
    
    // Check for a specific email (you can modify this)
    echo "\n=== CHECK SPECIFIC EMAIL ===\n";
    $testEmail = "jane.unique.test@example.com"; // Change this to your test email
    
    $specificUser = Capsule::table('users')->where('email', $testEmail)->first();
    
    if ($specificUser) {
        echo "✅ Email '{$testEmail}' EXISTS in database!\n";
        echo "User Details:\n";
        echo "- ID: {$specificUser->id}\n";
        echo "- Name: {$specificUser->name}\n";
        echo "- Created: {$specificUser->created_at}\n";
    } else {
        echo "❌ Email '{$testEmail}' NOT FOUND in database.\n";
        echo "💡 Try registering with this email or check if you used a different email.\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== VERIFICATION COMPLETE ===\n";
