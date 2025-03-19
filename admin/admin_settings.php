<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Handle form submission for updating settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = clean_input($_POST['site_name']);
    $contact_email = clean_input($_POST['contact_email']);
    $footer_text = clean_input($_POST['footer_text']);

    // Update settings in the database
    update_setting('site_name', $site_name);
    update_setting('contact_email', $contact_email);
    update_setting('footer_text', $footer_text);

    flash_message('Settings updated successfully.', 'success');
}

// Fetch current settings
$site_name = get_setting('site_name');
$contact_email = get_setting('contact_email');
$footer_text = get_setting('footer_text');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Settings</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="admin_posts.php">Manage Posts</a></li>
                <li><a href="admin_temples.php">Manage Temples</a></li>
                <li><a href="admin_artisans.php">Manage Artisans</a></li>
                <li><a href="admin_users.php">Manage Users</a></li>
                <li><a href="admin_settings.php">Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Update Settings</h2>
        <?php echo flash_message(); ?>
        <form action="admin_settings.php" method="post">
            <div>
                <label for="site_name">Site Name:</label>
                <input type="text" id="site_name" name="site_name" value="<?php echo $site_name; ?>" required>
            </div>
            <div>
                <label for="contact_email">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" value="<?php echo $contact_email; ?>" required>
            </div>
            <div>
                <label for="footer_text">Footer Text:</label>
                <textarea id="footer_text" name="footer_text" required><?php echo $footer_text; ?></textarea>
            </div>
            <div>
                <button type="submit">Update Settings</button>
            </div>
        </form>
    </main>
</body>
</html>