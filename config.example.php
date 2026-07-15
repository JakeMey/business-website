<?php
// ============================================
// Database Configuration - EXAMPLE FILE
// Copy this to config.php and add your credentials
// ============================================

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Your MySQL password
define('DB_NAME', 'business_db');

// Site configuration
define('SITE_NAME', 'Your Business Name');
define('SITE_EMAIL', 'info@yourbusiness.com');
define('SITE_PHONE', '(03) 0000 0000');
define('SITE_URL', 'http://localhost/business-website');

// Create database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ============================================
// 🇦🇺 Set timezone to Australian
// ============================================
date_default_timezone_set('Australia/Melbourne'); // Change to your city

// Set charset for UTF-8
mysqli_set_charset($conn, "utf8mb4");
?>