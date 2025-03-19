<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Handle form submission for creating/updating artisans
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name']);
    $craft_type = clean_input($_POST['craft_type']);
    $location = clean_input($_POST['location']);
    $bio = clean_input($_POST['bio']);
    $contact_info = clean_input($_POST['contact_info']);
    
    // Check if image upload is successful
    $featured_image = null;
    if (!empty($_FILES['featured_image']['name'])) {
        $featured_image = upload_image($_FILES['featured_image']);
        if ($featured_image === false) {
            flash_message('Error uploading image. Please try again.', 'danger');
            header('Location: admin_artisans.php');
            exit;
        }
    }

    if (isset($_POST['artisan_id']) && !empty($_POST['artisan_id'])) {
        // Update existing artisan
        $artisan_id = clean_input($_POST['artisan_id']);
        if ($featured_image) {
            $db->query("UPDATE artisans SET name = :name, craft_type = :craft_type, location = :location, bio = :bio, featured_image = :featured_image, contact_info = :contact_info, updated_at = NOW() WHERE id = :artisan_id");
            $db->bind(':featured_image', $featured_image);
        } else {
            $db->query("UPDATE artisans SET name = :name, craft_type = :craft_type, location = :location, bio = :bio, contact_info = :contact_info, updated_at = NOW() WHERE id = :artisan_id");
        }
        $db->bind(':artisan_id', $artisan_id);
    } else {
        // Create new artisan
        $db->query("INSERT INTO artisans (name, craft_type, location, bio, featured_image, contact_info, created_at, updated_at) VALUES (:name, :craft_type, :location, :bio, :featured_image, :contact_info, NOW(), NOW())");
        $db->bind(':featured_image', $featured_image);
    }

    $db->bind(':name', $name);
    $db->bind(':craft_type', $craft_type);
    $db->bind(':location', $location);
    $db->bind(':bio', $bio);
    $db->bind(':contact_info', $contact_info);

    if ($db->execute()) {
        flash_message('Artisan saved successfully.', 'success');
    } else {
        flash_message('Error saving artisan. Please try again.', 'danger');
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $artisan_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM artisans WHERE id = :artisan_id");
    $db->bind(':artisan_id', $artisan_id);
    if ($db->execute()) {
        flash_message('Artisan deleted successfully.', 'success');
    } else {
        flash_message('Error deleting artisan. Please try again.', 'danger');
    }
}

// Fetch all artisans
$db->query("SELECT * FROM artisans ORDER BY created_at DESC");
$artisans = $db->resultset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Artisans</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Manage Artisans</h1>
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
        <h2>Create/Edit Artisan</h2>
        <?php echo flash_message(); ?>
        <form action="admin_artisans.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="artisan_id" id="artisan_id">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="craft_type">Craft Type:</label>
                <input type="text" id="craft_type" name="craft_type" required>
            </div>
            <div>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div>
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" required></textarea>
            </div>
            <div>
                <label for="featured_image">Featured Image:</label>
                <input type="file" id="featured_image" name="featured_image">
            </div>
            <div>
                <label for="contact_info">Contact Info:</label>
                <input type="text" id="contact_info" name="contact_info" required>
            </div>
            <div>
                <button type="submit">Save Artisan</button>
            </div>
        </form>

        <h2>All Artisans</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Craft Type</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artisans as $artisan): ?>
                    <tr>
                        <td><?php echo $artisan['name']; ?></td>
                        <td><?php echo $artisan['craft_type']; ?></td>
                        <td><?php echo $artisan['location']; ?></td>
                        <td>
                            <a href="admin_artisans.php?edit=<?php echo $artisan['id']; ?>">Edit</a>
                            <a href="admin_artisans.php?delete=<?php echo $artisan['id']; ?>" onclick="return confirm('Are you sure you want to delete this artisan?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script>
        // Populate form for editing
        <?php if (isset($_GET['edit'])): ?>
            var artisan = <?php echo json_encode($db->single("SELECT * FROM artisans WHERE id = :artisan_id", [':artisan_id' => clean_input($_GET['edit'])])); ?>;
            document.getElementById('artisan_id').value = artisan.id;
            document.getElementById('name').value = artisan.name;
            document.getElementById('craft_type').value = artisan.craft_type;
            document.getElementById('location').value = artisan.location;
            document.getElementById('bio').value = artisan.bio;
            document.getElementById('contact_info').value = artisan.contact_info;
        <?php endif; ?>
    </script>
</body>
</html>