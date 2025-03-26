<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require_once '../config/config.php';
// require_once '../includes/auth.php';
// require_once '../includes/functions.php';

// Require admin login
// require_admin();

// Handle form submission for creating/updating artisans
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name']);
    $craft_type = clean_input($_POST['craft_type']);
    $location = clean_input($_POST['location']);
    $bio = clean_input($_POST['bio']);
    $contact_info = clean_input($_POST['contact_info']);
    
    // Check if image upload is successful
    // $featured_image = null;
    // if (!empty($_FILES['featured_image']['name'])) {
    //     $featured_image = upload_image($_FILES['featured_image']);
    //     if ($featured_image === false) {
    //         flash_message('Error uploading image. Please try again.', 'danger');
    //         header('Location: admin_artisans.php');
    //         exit;
    //     }
    // }
    $featured_image = null;
    if(!empty($_FILES['featured_image']['name'])){
        $featured_image = base64_encode(file_get_contents(addslashes($_FILES['featured_image']['tmp_name'])));
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
        header('location: ?page=artisans&status=success');
    } else {
        header('location: ?page=artisans&status=error_create');
    }
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $artisan_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM artisans WHERE id = :artisan_id");
    $db->bind(':artisan_id', $artisan_id);
    if ($db->execute()) {
        header('location: ?page=artisans&status=delete');
        
    } else {
        header('location: ?page=artisans&status=error_delete');
        
    }
    exit;
}

// Fetch all artisans
$db->query("SELECT * FROM artisans ORDER BY created_at DESC");
$artisans = $db->resultset();
?>

        <h2>Create/Edit Artisan</h2>
        <?php include '../includes/status.php';?>
        <form method="post" enctype="multipart/form-data" id="myForm">
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
                <label for="featured_image">Featured Image:</label><p id="size"></p>
                <input type="file" id="featured_image" name="featured_image" accept="image/x-png, image/jpeg" onchange=Filevalidation()>
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
                            <a href="?page=artisans&edit=<?php echo $artisan['id']; ?>">Edit</a>
                            <?php if(is_admin()): ?>
                            <a href="?page=artisans&delete=<?php echo $artisan['id']; ?>" onclick="return confirm('Are you sure you want to delete this artisan?');">Delete</a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
