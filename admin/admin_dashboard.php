<?php

// Require admin login
//require_admin();

// Fetch counts
$db->query("SELECT COUNT(*) AS count FROM posts");
$posts_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM temples");
$temples_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM artisans");
$artisans_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM users");
$users_count = $db->single()['count'];

$db->query("SELECT COUNT(*) AS count FROM contact_messages WHERE status='new'");
$message_count = $db->single()['count'];
?>



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
                <h3>Total New Message</h3>
                <p><?php echo $message_count; ?></p>
            </div>
            <?php if(is_admin()) :?>
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $users_count; ?></p>
            </div>
            <?php endif;?>
        </div>
