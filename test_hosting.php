<?php
// Simple hosting test file
// Upload this to your hosting provider to test if everything is working

echo "<h1>DigiFarm Hosting Test</h1>";
echo "<p>If you can see this, PHP is working on your hosting!</p>";

// Test database connection
echo "<h2>Database Connection Test</h2>";

// You'll need to update these with your hosting credentials
$host = 'your_hosting_mysql_host';
$dbname = 'your_database_name';
$username = 'your_db_username';
$password = 'your_db_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Test if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Database Tables:</h3>";
    if (empty($tables)) {
        echo "<p style='color: orange;'>⚠️ No tables found. You need to import the database.</p>";
    } else {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
        echo "<p style='color: green;'>✅ Database is properly set up!</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database credentials in the code above.</p>";
}

// Test PHP extensions
echo "<h2>PHP Extensions Test</h2>";
$required_extensions = ['pdo', 'pdo_mysql', 'session'];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<p style='color: green;'>✅ $ext extension is loaded</p>";
    } else {
        echo "<p style='color: red;'>❌ $ext extension is missing</p>";
    }
}

// Test file permissions
echo "<h2>File Permissions Test</h2>";
$test_file = __FILE__;
if (is_readable($test_file)) {
    echo "<p style='color: green;'>✅ File permissions are correct</p>";
} else {
    echo "<p style='color: red;'>❌ File permission issues detected</p>";
}

echo "<hr>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>Update the database credentials in this file</li>";
echo "<li>Upload all your DigiFarm files</li>";
echo "<li>Import the database using phpMyAdmin</li>";
echo "<li>Test your main website</li>";
echo "</ol>";

echo "<p><a href='index.html' style='background: #65b741; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Main Website</a></p>";
?>
