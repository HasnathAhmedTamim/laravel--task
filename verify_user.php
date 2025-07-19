<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check if password is hashed
$user = App\Models\User::find(11);
if ($user) {
    echo "✅ User Registration Verification:\n";
    echo "- User ID: " . $user->id . "\n";
    echo "- Name: " . $user->name . "\n";
    echo "- Email: " . $user->email . "\n";
    echo "- Password is hashed: " . (strlen($user->password) > 50 ? 'YES' : 'NO') . "\n";
    echo "- Password length: " . strlen($user->password) . " characters\n";
    echo "- Created at: " . $user->created_at . "\n";
    
    // Verify password format (bcrypt hash)
    if (preg_match('/^\$2[ayb]\$.{56}$/', $user->password)) {
        echo "- Password format: ✅ Proper bcrypt hash\n";
    } else {
        echo "- Password format: ❌ Not a valid bcrypt hash\n";
    }
} else {
    echo "❌ User not found\n";
}
