<?php
// Script to fix admin password
require_once 'config/database.php';

echo "<h2>Fix Admin Password</h2>";

try {
    // Check current admin user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch();
    
    if ($admin) {
        echo "<p><strong>Current Admin User:</strong></p>";
        echo "<p>Username: " . $admin['username'] . "</p>";
        echo "<p>Email: " . $admin['email'] . "</p>";
        echo "<p>Current Password Hash: " . $admin['password'] . "</p>";
        
        // Generate correct password hash for 'admin123'
        $correct_hash = password_hash('admin123', PASSWORD_DEFAULT);
        
        // Update the password
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
        $result = $stmt->execute([$correct_hash]);
        
        if ($result) {
            echo "<p style='color: green;'><strong>✅ Password updated successfully!</strong></p>";
            echo "<p>New password hash: " . $correct_hash . "</p>";
            echo "<p><strong>You can now login with:</strong></p>";
            echo "<ul>";
            echo "<li>Username: admin</li>";
            echo "<li>Password: admin123</li>";
            echo "</ul>";
            
            // Verify the password works
            if (password_verify('admin123', $correct_hash)) {
                echo "<p style='color: green;'>✅ Password verification successful!</p>";
            } else {
                echo "<p style='color: red;'>❌ Password verification failed!</p>";
            }
            
        } else {
            echo "<p style='color: red;'><strong>❌ Failed to update password!</strong></p>";
        }
        
    } else {
        echo "<p style='color: red;'><strong>❌ Admin user not found!</strong></p>";
        echo "<p><a href='create_admin.php'>Click here to create admin user</a></p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><strong>Database Error:</strong> " . $e->getMessage() . "</p>";
}

echo "<br><br>";
echo "<a href='login.php' style='background: #65b741; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page</a>";
echo "&nbsp;&nbsp;";
echo "<a href='test_admin.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Admin Login</a>";
?>
