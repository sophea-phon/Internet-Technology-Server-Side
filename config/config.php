<?php
// Application configuration

// Site configuration
define('SITE_NAME', 'Cambodia Heritage');
define('SITE_URL', 'http://localhost/cambodia-heritage/Internet-Technology-Server-Side'); // Change to your actual URL

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Change to your DB username
define('DB_PASS', '');           // Change to your DB password
define('DB_NAME', 'cambodia_heritage');

// Paths
define('BASE_PATH', dirname(__DIR__) . '/');
define('ADMIN_PATH', BASE_PATH . 'admin/');
define('UPLOAD_PATH', BASE_PATH . 'uploads/');
define('ASSET_PATH', BASE_PATH . 'assets/');

// URL paths
define('BASE_URL', SITE_URL);
define('ADMIN_URL', BASE_URL . '/admin');
define('UPLOAD_URL', BASE_URL . '/uploads');
define('ASSET_URL', BASE_URL . '/assets');

// Session configuration
define('SESSION_NAME', 'cambodia_heritage_session');
define('SESSION_LIFETIME', 3600); // 1 hour

// Initialize session
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}