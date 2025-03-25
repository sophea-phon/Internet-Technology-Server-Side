<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
//require_admin();


$validatePage = array(
    'dashboard' => 'admin_dashboard',
    'posts' => 'admin_posts',
    'settings' => 'admin_settings',
    'temples' => 'admin_temples',
    'users' => 'admin_users',
    'artisans'=>'admin_artisans'
  );

$titlePage = array(
    'dashboard' => 'Admin Dashboard',
    'posts' => 'Manage Posts',
    'settings' => 'Settings',
    'temples' => 'Manage Temples',
    'users' => 'Manage Users',
    'artisans'=>'Manage Artisans'
)
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
        <h1><?php echo $titlePage[$_GET['page']] ?></h1>
        <nav>
            <ul>
                <li><a href="?page=dashboard">Home</a></li>
                <li><a href="?page=posts">Manage Posts</a></li>
                <li><a href="?page=temples">Manage Temples</a></li>
                <li><a href="?page=artisans">Manage Artisans</a></li>
                <?php if(is_admin()) {?>
                <li><a href="?page=users">Manage Users</a></li>
                <?php } ?>
                <li><a href="?page=settings">Settings</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        if($_GET['page'] && isset($validatePage[$_GET['page']]) && ctype_lower($_GET['page']) && !ctype_space($_GET['page'])){
            $incPage = $validatePage[$_GET['page']] . '.php';
            // if you want to use a line like this - you would need a lot more 
            // validation to avoid MAJOR security issues,
            // maybe only characters 'a-z' & '_', for a start! 
            // adding a pass through 'realpath()' would also help
        include $incPage;
        }else{
            if(basename(__FILE__) == "index.php"){
                header("Location: ?page=dashboard");
                exit;
            }else{
                echo '404';
            }
        }
        ?>
       
    </main>
    <script>
        <?php 
        if($_GET['page'] && isset($validatePage[$_GET['page']]) && ctype_lower($_GET['page']) && !ctype_space($_GET['page'])):
            $page = $validatePage[$_GET['page']];
            $isedit = isset($_GET['edit']);
            $edit =0;
            if($isedit){
                $edit = clean_input($_GET['edit']);
            }
            
            if($page == "admin_posts" && $isedit):
        ?>
                var post = <?php
                    $db->query("SELECT * FROM posts WHERE id = $edit");
                    echo json_encode($db->single());
                    ?>;
                document.getElementById('post_id').value = post.id;
                document.getElementById('title').value = post.title;
                document.getElementById('content').value = post.content;
                document.getElementById('status').value = post.status;
            <?php elseif($page == "admin_temples" && $isedit): ?>
                var temple = <?php 
                    $db->query("SELECT * FROM temples WHERE id = $edit");
                    echo json_encode($db->single()); ?>;
                document.getElementById('temple_id').value = temple.id;
                document.getElementById('name').value = temple.name;
                document.getElementById('location').value = temple.location;
                document.getElementById('description').value = temple.description;
                document.getElementById('history').value = temple.history;
            <?php elseif($page == "admin_artisans" && $isedit): ?>
                var artisan = <?php 
                    $db->query("SELECT * FROM artisans WHERE id =$edit");
                    echo json_encode($db->single()); ?>;
                document.getElementById('artisan_id').value = artisan.id;
                document.getElementById('name').value = artisan.name;
                document.getElementById('craft_type').value = artisan.craft_type;
                document.getElementById('location').value = artisan.location;
                document.getElementById('bio').value = artisan.bio;
                document.getElementById('contact_info').value = artisan.contact_info;
            <?php elseif($page=="admin_users" && $isedit): ?>
                var user = <?php
                    $db->query("SELECT * FROM users WHERE id = $edit");
                    echo json_encode($db->single()); ?>;
            document.getElementById('user_id').value = user.id;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
            <?php endif; ?>
            
        <?php endif; ?>
    </script>
</body>
</html>