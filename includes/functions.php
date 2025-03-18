<?php
// Helper functions

// Clean input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Generate slug from string
function generate_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', ' ', $string);
    $string = preg_replace('/\s/', '-', $string);
    return $string;
}

// Format date
function format_date($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

// Truncate text
function truncate_text($text, $limit = 150) {
    if (strlen($text) <= $limit) {
        return $text;
    }
    
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    return $text . '...';
}

// Upload image
function upload_image($file, $directory = 'uploads/') {
    // Check if file was uploaded without errors
    if ($file['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        // Check if the file extension is allowed
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            // Generate unique filename
            $new_filename = uniqid() . '.' . $file_extension;
            $upload_path = BASE_PATH . $directory . $new_filename;
            
            // Move the uploaded file
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                return $directory . $new_filename;
            }
        }
    }
    
    return false;
}

// Check if user is logged in
// function is_logged_in() {
//     return isset($_SESSION['user_id']);
// }

// Check if user is admin
// function is_admin() {
//     return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
// }

// Redirect to URL
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

// Display flash message
function flash_message($message = '', $type = 'info') {
    if (!empty($message)) {
        $_SESSION['flash_message'] = [
            'message' => $message,
            'type' => $type
        ];
    } else if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];
        unset($_SESSION['flash_message']);
        
        return "<div class='alert alert-{$type}'>{$message}</div>";
    }
    
    return '';
}

// Get site setting
function get_setting($key) {
    global $db;
    
    $db->query("SELECT setting_value FROM settings WHERE setting_key = :key");
    $db->bind(':key', $key);
    $result = $db->single();
    
    return $result ? $result['setting_value'] : '';
}

// Update site setting
function update_setting($key, $value) {
    global $db;
    
    $db->query("UPDATE settings SET setting_value = :value WHERE setting_key = :key");
    $db->bind(':key', $key);
    $db->bind(':value', $value);
    
    return $db->execute();
}