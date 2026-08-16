<?php
session_start();

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default empty password for local development
define('DB_NAME', 'electrician_db');

try {
    // Connect without database first to create it if it doesn't exist
    $pdo_setup = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo_setup->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create DB
    $pdo_setup->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    
    // Connect to the specific database
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Create Tables
    $queries = [
        "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS enquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            email VARCHAR(100) NOT NULL,
            address TEXT,
            service VARCHAR(100),
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(100) NOT NULL,
            rating INT NOT NULL DEFAULT 5,
            review_text TEXT NOT NULL,
            is_published TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS services (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(150) NOT NULL,
            description TEXT,
            icon VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            setting_key VARCHAR(50) NOT NULL UNIQUE,
            setting_value TEXT
        )"
    ];
    
    foreach ($queries as $query) {
        $pdo->exec($query);
    }
    
    // Insert default admin if not exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = 'admin'");
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
        $insert_admin = $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', ?)");
        $insert_admin->execute([$hashed_password]);
    }

    // Insert default settings if not exists
    $default_settings = [
        'contact_phone' => '+91 8754491029',
        'contact_whatsapp' => '8754491029',
        'contact_email' => 'srinivasanvr25@gmail.com',
        'contact_address' => 'Urappakam Chengalpattu District
Tamil Nadu India Pin - 603210',
        'business_hours' => 'Mon - Sat: 8:00 AM - 8:00 PM, Sun: Emergency Only',
        'facebook_url' => 'https://www.facebook.com/profile.php?id=100015187126931',
        'instagram_url' => 'https://www.instagram.com/srini____electricals?igsh=MWN0aWx3NDhvczEwbQ==',
        'twitter_url' => '#'
    ];

    foreach ($default_settings as $key => $value) {
        $stmt = $pdo->prepare("SELECT id FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        if ($stmt->rowCount() == 0) {
            $insert_setting = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)");
            $insert_setting->execute([$key, $value]);
        }
    }
    

    
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage() . ". Please ensure MySQL is running and credentials are correct.");
}

// Helper function to get settings
function get_setting($pdo, $key) {
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    return $result ? $result['setting_value'] : '';
}
?>
