<?php
// Missing Pages Checker for DigiFarm
echo "<h2>🔍 DigiFarm Missing Pages Checker</h2>";

// Define all expected files
$expected_files = [
    // Root files
    'index.html' => 'Main landing page',
    'style.css' => 'Main stylesheet',
    'script.js' => 'Main JavaScript file',
    'login.php' => 'User login page',
    'register.php' => 'User registration page',
    'logout.php' => 'User logout page',
    'marketplace.php' => 'Public marketplace page',
    
    // Config files
    'config/database.php' => 'Database configuration',
    
    // Farmer files
    'farmer/dashboard.php' => 'Farmer dashboard',
    'farmer/profile.php' => 'Farmer profile page',
    'farmer/expert-enquiry.php' => 'Expert enquiry form',
    'farmer/service-request.php' => 'Service request form',
    'farmer/supply-request.php' => 'Supply request form',
    'farmer/add-product.php' => 'Add product form',
    'farmer/marketplace.php' => 'Farmer marketplace (requires login)',
    
    // Admin files
    'admin/dashboard.php' => 'Admin dashboard',
    'admin/profile.php' => 'Admin profile page',
    'admin/add-expert.php' => 'Add expert form',
    'admin/add-supply.php' => 'Add supply form',
    'admin/add-service.php' => 'Add service form',
    
    // Utility files
    'test_links.php' => 'Link test page',
    'test_admin.php' => 'Admin test page',
    'db_test.php' => 'Database test page',
    'create_admin.php' => 'Create admin user',
    'fix_admin_password.php' => 'Fix admin password',
    'database_setup.sql' => 'Database setup script',
    'DATABASE_SETUP_GUIDE.md' => 'Database setup guide',
    'README.md' => 'Project documentation'
];

echo "<div style='max-width: 1200px; margin: 0 auto; padding: 20px;'>";
echo "<div style='background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";

echo "<h3>📋 Complete File List</h3>";
echo "<table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>";
echo "<tr style='background: #f8f9fa;'>";
echo "<th style='padding: 12px; text-align: left; border: 1px solid #ddd;'>File Path</th>";
echo "<th style='padding: 12px; text-align: left; border: 1px solid #ddd;'>Description</th>";
echo "<th style='padding: 12px; text-align: center; border: 1px solid #ddd;'>Status</th>";
echo "</tr>";

$missing_files = [];
$existing_files = [];

foreach ($expected_files as $file => $description) {
    if (file_exists($file)) {
        echo "<tr>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'><strong>$file</strong></td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'>$description</td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>";
        echo "<span style='background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: bold;'>✅ EXISTS</span>";
        echo "</td>";
        echo "</tr>";
        $existing_files[] = $file;
    } else {
        echo "<tr style='background: #fff5f5;'>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'><strong>$file</strong></td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'>$description</td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>";
        echo "<span style='background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: bold;'>❌ MISSING</span>";
        echo "</td>";
        echo "</tr>";
        $missing_files[] = $file;
    }
}

echo "</table>";

echo "<div style='margin-top: 30px; padding: 20px; background: #e9ecef; border-radius: 5px;'>";
echo "<h3>📊 Summary</h3>";
echo "<p><strong>Total Files Expected:</strong> " . count($expected_files) . "</p>";
echo "<p><strong>Files Found:</strong> " . count($existing_files) . " ✅</p>";
echo "<p><strong>Files Missing:</strong> " . count($missing_files) . " ❌</p>";

if (count($missing_files) > 0) {
    echo "<h4>Missing Files:</h4>";
    echo "<ul>";
    foreach ($missing_files as $file) {
        echo "<li><code>$file</code> - " . $expected_files[$file] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h4 style='color: #155724;'>🎉 All files are present! Your DigiFarm installation is complete.</h4>";
}

echo "</div>";

echo "<div style='margin-top: 30px; padding: 20px; background: #d1ecf1; border-radius: 5px;'>";
echo "<h3>🔗 Quick Access Links</h3>";
echo "<p><a href='test_links.php' style='color: #0c5460; font-weight: bold;'>🔗 Test All Links</a> - Check if all pages work correctly</p>";
echo "<p><a href='index.html' style='color: #0c5460; font-weight: bold;'>🏠 Home Page</a> - Main landing page</p>";
echo "<p><a href='login.php' style='color: #0c5460; font-weight: bold;'>🔐 Login Page</a> - User authentication</p>";
echo "<p><a href='marketplace.php' style='color: #0c5460; font-weight: bold;'>🛒 Public Marketplace</a> - Browse products</p>";
echo "</div>";

echo "</div>";
echo "</div>";
?>
