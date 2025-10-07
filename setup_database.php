<?php

// Database Setup Script
// Run this with: php setup_database.php

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'students';

try {
    // Connect to MySQL without selecting a database
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->exec($sql);
    
    echo "✓ Database '$database' created successfully!\n";
    echo "\nNow run: php artisan migrate\n";
    
} catch(PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\nPlease make sure:\n";
    echo "1. XAMPP MySQL is running\n";
    echo "2. MySQL credentials are correct in .env file\n";
    exit(1);
}

