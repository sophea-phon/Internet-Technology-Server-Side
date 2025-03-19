<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Fetch counts
$db->query("SELECT COUNT(*) AS count FROM posts");
$posts_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM temples");
$temples_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM artisans");
$artisans_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM users");
$users_count = $db->single()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        .dashboard-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            flex: 1;
            min-width: 200px;
            text-align: center;
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .card p {
            font-size: 1.5em;
            margin: 10px 0;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
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
        <h2>Welcome, <?php echo $_SESSION['user_username']; ?>!</h2>
        <p>Use the navigation menu to manage the website content.</p>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Posts</h3>
                <p><?php echo $posts_count; ?></p>
            </div>
            <div class="card">
                <h3>Total Temples</h3>
                <p><?php echo $temples_count; ?></p>
            </div>
            <div class="card">
                <h3>Total Artisans</h3>
                <p><?php echo $artisans_count; ?></p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $users_count; ?></p>
            </div>
        </div>
    </main>
</body>
</html>