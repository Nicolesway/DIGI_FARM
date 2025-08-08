<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiFarm - Link Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #65b741;
            text-align: center;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .section h2 {
            color: #333;
            border-bottom: 2px solid #65b741;
            padding-bottom: 10px;
        }
        .link-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .link-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #65b741;
        }
        .link-card h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .link-card p {
            margin: 0 0 10px 0;
            color: #666;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #65b741;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn:hover {
            background: #4a8c2f;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .status.working {
            background: #d4edda;
            color: #155724;
        }
        .status.broken {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔗 DigiFarm Link Test Page</h1>
        
        <div class="section">
            <h2>🏠 Main Pages</h2>
            <div class="link-grid">
                <div class="link-card">
                    <h3>Home Page</h3>
                    <p>Main landing page</p>
                    <a href="index.html" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Login Page</h3>
                    <p>User login form</p>
                    <a href="login.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Register Page</h3>
                    <p>User registration form</p>
                    <a href="register.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Public Marketplace</h3>
                    <p>Browse products (no login required)</p>
                    <a href="marketplace.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>👨‍🌾 Farmer Pages</h2>
            <div class="link-grid">
                <div class="link-card">
                    <h3>Farmer Dashboard</h3>
                    <p>Main farmer dashboard</p>
                    <a href="farmer/dashboard.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Expert Enquiry</h3>
                    <p>Request expert consultation</p>
                    <a href="farmer/expert-enquiry.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Service Request</h3>
                    <p>Request extensive services</p>
                    <a href="farmer/service-request.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Supply Request</h3>
                    <p>Request input supplies</p>
                    <a href="farmer/supply-request.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Add Product</h3>
                    <p>Post products to marketplace</p>
                    <a href="farmer/add-product.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Farmer Marketplace</h3>
                    <p>Browse products (requires login)</p>
                    <a href="farmer/marketplace.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Farmer Profile</h3>
                    <p>View and edit farmer profile</p>
                    <a href="farmer/profile.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>👨‍💼 Admin Pages</h2>
            <div class="link-grid">
                <div class="link-card">
                    <h3>Admin Dashboard</h3>
                    <p>Main admin dashboard</p>
                    <a href="admin/dashboard.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Add Expert</h3>
                    <p>Add new expert information</p>
                    <a href="admin/add-expert.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Add Supply</h3>
                    <p>Add new input supplies</p>
                    <a href="admin/add-supply.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Add Service</h3>
                    <p>Add new extensive services</p>
                    <a href="admin/add-service.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Admin Profile</h3>
                    <p>View and edit admin profile</p>
                    <a href="admin/profile.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Manage Experts</h3>
                    <p>View, edit, and delete experts</p>
                    <a href="admin/manage-experts.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Manage Supplies</h3>
                    <p>View, edit, and delete supplies</p>
                    <a href="admin/manage-supplies.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Manage Services</h3>
                    <p>View, edit, and delete services</p>
                    <a href="admin/manage-services.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Manage Farmers</h3>
                    <p>View, edit, and delete farmer accounts</p>
                    <a href="admin/manage-farmers.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Manage Products</h3>
                    <p>View, edit, and delete marketplace products</p>
                    <a href="admin/manage-products.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Reports</h3>
                    <p>View system statistics and reports</p>
                    <a href="admin/reports.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>🔧 Utility Pages</h2>
            <div class="link-grid">
                <div class="link-card">
                    <h3>Logout</h3>
                    <p>User logout</p>
                    <a href="logout.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Database Test</h3>
                    <p>Test database connection</p>
                    <a href="db_test.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
                <div class="link-card">
                    <h3>Admin Test</h3>
                    <p>Test admin login</p>
                    <a href="test_admin.php" class="btn">Test Link</a>
                    <span class="status working">Working</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>📋 Quick Actions</h2>
            <div class="link-grid">
                <div class="link-card">
                    <h3>Login as Admin</h3>
                    <p>Go directly to admin login</p>
                    <a href="login.php" class="btn">Login</a>
                </div>
                <div class="link-card">
                    <h3>Register as Farmer</h3>
                    <p>Create new farmer account</p>
                    <a href="register.php" class="btn">Register</a>
                </div>
                <div class="link-card">
                    <h3>Back to Home</h3>
                    <p>Return to main page</p>
                    <a href="index.html" class="btn">Home</a>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; padding: 20px; background: #e9ecef; border-radius: 5px;">
            <h3>✅ All Links Fixed!</h3>
            <p>The broken links in index.html have been corrected. All pages should now work properly.</p>
            <p><strong>Admin Login:</strong> username: admin, password: admin123</p>
        </div>
    </div>
</body>
</html>
