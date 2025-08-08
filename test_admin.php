<?php
// Test script to check admin login
require_once 'config/database.php';

echo "<h2>DigiFarm Admin Login Test</h2>";

try {
    // Test database connection
    echo "<h3>1. Database Connection Test</h3>";
    echo "Database connection: <strong style='color: green;'>SUCCESS</strong><br>";
    echo "Database name: " . $dbname . "<br><br>";
    
    // Check if users table exists
    echo "<h3>2. Table Check</h3>";
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "Users table: <strong style='color: green;'>EXISTS</strong><br>";
    } else {
        echo "Users table: <strong style='color: red;'>NOT FOUND</strong><br>";
    }
    
    // Check admin user
    echo "<h3>3. Admin User Check</h3>";
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch();
    
    if ($admin) {
        echo "Admin user: <strong style='color: green;'>FOUND</strong><br>";
        echo "Username: " . $admin['username'] . "<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "User Type: " . $admin['user_type'] . "<br>";
        echo "Full Name: " . $admin['full_name'] . "<br>";
        
        // Test password verification
        echo "<h3>4. Password Test</h3>";
        $test_password = 'admin123';
        if (password_verify($test_password, $admin['password'])) {
            echo "Password 'admin123': <strong style='color: green;'>CORRECT</strong><br>";
        } else {
            echo "Password 'admin123': <strong style='color: red;'>INCORRECT</strong><br>";
        }
        
        // Show hashed password for debugging
        echo "Hashed password: " . $admin['password'] . "<br>";
        
    } else {
        echo "Admin user: <strong style='color: red;'>NOT FOUND</strong><br>";
        echo "<p>You need to run the database setup script first!</p>";
    }
    
    // Show all users
    echo "<h3>5. All Users in Database</h3>";
    $stmt = $pdo->query("SELECT id, username, email, user_type, created_at FROM users");
    $users = $stmt->fetchAll();
    
    if (count($users) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Type</th><th>Created</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['user_type'] . "</td>";
            echo "<td>" . $user['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found in database.<br>";
    }
    
} catch (PDOException $e) {
    echo "<h3>Database Error</h3>";
    echo "<strong style='color: red;'>Error:</strong> " . $e->getMessage() . "<br>";
    echo "<p>Please check your database configuration in config/database.php</p>";
}

echo "<br><br>";
echo "<h3>6. Quick Fix Options</h3>";
echo "<p>If admin user is not found, you can:</p>";
echo "<ol>";
echo "<li>Run the database_setup.sql script in phpMyAdmin</li>";
echo "<li>Or manually create the admin user with this SQL:</li>";
echo "</ol>";

echo "<pre style='background: #f5f5f5; padding: 10px; border-radius: 5px;'>";
echo "INSERT INTO users (username, email, password, full_name, phone, user_type) VALUES ";
echo "('admin', 'admin@digifarm.com', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'System Administrator', '+1234567890', 'admin');";
echo "</pre>";
?>
