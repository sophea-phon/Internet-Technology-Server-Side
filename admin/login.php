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
    $password = clean_input($_POST['password']);

    // Check user in database
    global $db;
    $db->query("SELECT * FROM users WHERE username = :username");
    $db->bind(':username', $username);

    $user = $db->single();
    if(login_user($username,$password)){
        
        if(!is_admin()){
            header('location: ../index?page=home');
            exit;
        }else{
            header('location: index?page=dashboard');
            exit;
        } 
    }else{
        $error_message = 'Invalid username or password.';
    }
    // if ($user && password_verify($password, $user['password'])) {
    //     // Set session
    //     $_SESSION['user_id'] = $user['id'];
    //     $_SESSION['user_username'] = $user['username'];
    //     $_SESSION['user_email'] = $user['email'];
    //     $_SESSION['user_role'] = $user['role'];
    //     $_SESSION['logged_in'] = true;
    //     echo var_dump($user);

    //     // Redirect to admin dashboard
    //     header('Location: index');
    //     exit;
    // } else {
    //     $error_message = 'Invalid username or password.';
    // }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
   <div>
   <h1>Login</h1>
    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    <p>Don't have an account? <a href="signup">Signup here</a>.</p>
   </div>
</body>
</html>