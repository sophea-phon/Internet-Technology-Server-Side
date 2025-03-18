<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username']);
    $password = password_hash(clean_input($_POST['password']), PASSWORD_BCRYPT);
    $email = clean_input($_POST['email']);
    $role = 'user'; // Default role

    // Insert user into database
    global $db;
    $db->query("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
    $db->bind(':username', $username);
    $db->bind(':password', $password);
    $db->bind(':email', $email);
    $db->bind(':role', $role);

    if ($db->execute()) {
        // Redirect to login page
        header('Location: login.php');
        exit;
    } else {
        $error_message = 'Error creating account. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div>
    <h1>Signup</h1>
    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="signup.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <button type="submit">Signup</button>
        </div>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
    
</body>
</html>