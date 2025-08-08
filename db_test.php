<?php
// Simple database connection test
echo "<h2>Database Connection Test</h2>";

try {
    require_once 'config/database.php';
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    echo "<p>Database: $dbname</p>";
    
    // Test if we can query the database
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch();
    echo "<p>Total users in database: " . $result['count'] . "</p>";
    
    // Check for admin user specifically
    $stmt = $pdo->prepare("SELECT username, user_type FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch();
    
    if ($admin) {
        echo "<p style='color: green;'>✅ Admin user found!</p>";
        echo "<p>Username: " . $admin['username'] . "</p>";
        echo "<p>Type: " . $admin['user_type'] . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Admin user not found!</p>";
        echo "<p><a href='create_admin.php'>Click here to create admin user</a></p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Database connection failed!</p>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your config/database.php file</p>";
}

echo "<br><br>";
echo "<a href='login.php'>Go to Login</a> | ";
echo "<a href='test_admin.php'>Full Admin Test</a> | ";
echo "<a href='create_admin.php'>Create Admin</a>";
?>
