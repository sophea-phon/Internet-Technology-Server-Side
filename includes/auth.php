<?php
/**
 * Authentication System
 * Cambodia Heritage Dynamic Website
 * 
 * @author naingseiha
 * @date 2025-03-18 18:29:56
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection if not already included
if (!function_exists('clean_input')) {
    require_once dirname(__DIR__) . '/includes/functions.php';
}

// Database connection
require_once dirname(__DIR__) . '/config/database.php';
$db = new Database();

/**
 * Register a new user
 * 
 * @param string $username User's username
 * @param string $email User's email
 * @param string $password User's password (plain text)
 * @param string $role User's role (default: 'user')
 * @return int|bool User ID if successful, false otherwise
 */
function register_user($username, $email, $password, $role = 'user') {
    global $db;
    
    // Clean data
    $username = clean_input($username);
    $email = clean_input($email);
    
    // Validate data
    if (empty($username) || empty($email) || empty($password)) {
        return false;
    }
    
    // Check if username already exists
    $db->query("SELECT * FROM users WHERE username = :username OR email = :email");
    $db->bind(':username', $username);
    $db->bind(':email', $email);
    
    if ($db->rowCount() > 0) {
        return false; // Username or email already exists
    }
    
    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $db->query("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
    $db->bind(':username', $username);
    $db->bind(':email', $email);
    $db->bind(':password', $password_hash);
    $db->bind(':role', $role);
    
    // Execute
    if ($db->execute()) {
        return $db->lastInsertId();
    }
    
    return false;
}

/**
 * Login a user
 * 
 * @param string $username Username or email
 * @param string $password Password (plain text)
 * @param bool $remember Remember login (default: false)
 * @return bool True if successful, false otherwise
 */
function login_user($username, $password, $remember = false) {
    global $db;
    
    // Clean input
    $username = clean_input($username);
    
    // Check for username or email
    $db->query("SELECT * FROM users WHERE username = :username OR email = :email");
    $db->bind(':username', $username);
    $db->bind(':email', $username);
    
    $user = $db->single();
    
    // Check if user exists
    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            
            // Set remember me cookie if requested
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (30 * 24 * 60 * 60); // 30 days
                
                // Store token in database
                $db->query("UPDATE users SET remember_token = :token WHERE id = :id");
                $db->bind(':token', $token);
                $db->bind(':id', $user['id']);
                $db->execute();
                
                // Set cookie
                setcookie('remember_token', $token, $expires, '/', '', false, true);
                setcookie('remember_user', $user['id'], $expires, '/', '', false, true);
            }
            
            return true;
        }
    }
    
    return false;
}

/**
 * Check if user is logged in
 * 
 * @return bool True if logged in, false otherwise
 */
function is_logged_in() {
    // Check session
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        return true;
    }
    
    // Check for remember me cookie
    if (isset($_COOKIE['remember_token']) && isset($_COOKIE['remember_user'])) {
        global $db;
        
        $token = $_COOKIE['remember_token'];
        $user_id = $_COOKIE['remember_user'];
        
        $db->query("SELECT * FROM users WHERE id = :id AND remember_token = :token");
        $db->bind(':id', $user_id);
        $db->bind(':token', $token);
        
        $user = $db->single();
        
        if ($user) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            
            return true;
        }
        
        // Invalid cookie, clear it
        setcookie('remember_token', '', time() - 3600, '/');
        setcookie('remember_user', '', time() - 3600, '/');
    }
    
    return false;
}

/**
 * Check if user is admin
 * 
 * @return bool True if admin, false otherwise
 */
function is_admin() {
    //return isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'admin';
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Check if user is editor
 * 
 * @return bool True if editor, false otherwise
 */
function is_editor() {
    return isset($_SESSION['user_role']) && 
          ($_SESSION['user_role'] === 'editor');
}

function is_user() {
    return isset($_SESSION['user_role']) && 
          ($_SESSION['user_role'] === 'user');
}

/**
 * Require user to be logged in
 * Redirects to login page if not logged in
 * 
 * @param string $redirect Redirect URL after login
 */
function require_login($redirect = null) {
    if (!is_logged_in()) {
        // Set redirect URL in session
        if ($redirect) {
            $_SESSION['redirect_after_login'] = $redirect;
        } else {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        }
        
        // Redirect to login page
        header('Location: ' . BASE_URL . '/admin/login');
        exit;
    }
}

/**
 * Require user to be admin
 * Redirects to login page if not admin
 */
function require_admin() {
    require_login();
    exit;
    if (!is_admin()) {
        // Not an admin, redirect to home
        set_flash_message('You do not have permission to access that page.', 'danger');
        header('Location: ' . BASE_URL . '/index?page=home');
        exit;
    }
}

/**
 * Require user to be editor
 * Redirects to login page if not editor
 */
function require_editor() {
    require_login();
    
    if (!is_editor()) {
        // Not an editor, redirect to home
        set_flash_message('You do not have permission to access that page.', 'danger');
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

/**
 * Log out a user
 * 
 * @param bool $redirect Whether to redirect after logout
 * @return void
 */
function logout_user($redirect = true) {
    // Clear session data
    $_SESSION = array();
    
    // Destroy session
    session_destroy();
    
    // Clear cookies
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/');
        setcookie('remember_user', '', time() - 3600, '/');
    }
    
    // Redirect to home page
    if ($redirect) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

/**
 * Get current user data
 * 
 * @return array|bool User data if logged in, false otherwise
 */
function get_custom_current_user() {
    if (!is_logged_in()) {
        return false;
    }
    
    global $db;
    
    $db->query("SELECT id, username, email, role, created_at FROM users WHERE id = :id");
    $db->bind(':id', $_SESSION['user_id']);
    
    return $db->single();
}

/**
 * Set flash message
 * 
 * @param string $message Message to display
 * @param string $type Message type (success, info, warning, danger)
 * @return void
 */
function set_flash_message($message, $type = 'info') {
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
 * Display flash message
 * 
 * @return string HTML for flash message or empty string
 */
function display_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];
        unset($_SESSION['flash_message']);
        
        return "<div class='alert alert-{$type}'>{$message}</div>";
    }
    
    return '';
}

/**
 * Update user password
 * 
 * @param int $user_id User ID
 * @param string $current_password Current password
 * @param string $new_password New password
 * @return bool True if successful, false otherwise
 */
function update_password($user_id, $current_password, $new_password) {
    global $db;
    
    // Get user
    $db->query("SELECT * FROM users WHERE id = :id");
    $db->bind(':id', $user_id);
    $user = $db->single();
    
    if (!$user) {
        return false;
    }
    
    // Verify current password
    if (!password_verify($current_password, $user['password'])) {
        return false;
    }
    
    // Hash new password
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update password
    $db->query("UPDATE users SET password = :password WHERE id = :id");
    $db->bind(':password', $password_hash);
    $db->bind(':id', $user_id);
    
    return $db->execute();
}