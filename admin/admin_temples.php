<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Database connection
$db = new Database();

// Handle form submission for creating/updating temples
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name']);
    $location = clean_input($_POST['location']);
    $description = clean_input($_POST['description']);
    $history = clean_input($_POST['history']);
    $featured_image = !empty($_FILES['featured_image']['name']) ? upload_image($_FILES['featured_image']) : '';

    if (isset($_POST['temple_id']) && $_POST['temple_id'] != '') {
        // Update existing temple
        $temple_id = clean_input($_POST['temple_id']);
        $query = "UPDATE temples SET name = :name, location = :location, description = :description, history = :history, updated_at = NOW()";
        if ($featured_image != '') {
            $query .= ", featured_image = :featured_image";
        }
        $query .= " WHERE id = :temple_id";
        $db->query($query);
        $db->bind(':name', $name);
        $db->bind(':location', $location);
        $db->bind(':description', $description);
        $db->bind(':history', $history);
        if ($featured_image != '') {
            $db->bind(':featured_image', $featured_image);
        }
        $db->bind(':temple_id', $temple_id);
    } else {
        // Create new temple
        $db->query("INSERT INTO temples (name, location, description, history, featured_image, created_at, updated_at) VALUES (:name, :location, :description, :history, :featured_image, NOW(), NOW())");
        $db->bind(':name', $name);
        $db->bind(':location', $location);
        $db->bind(':description', $description);
        $db->bind(':history', $history);
        $db->bind(':featured_image', $featured_image);
    }

    if ($db->execute()) {
        flash_message('Temple saved successfully.', 'success');
    } else {
        flash_message('Error saving temple. Please try again.', 'danger');
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $temple_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM temples WHERE id = :temple_id");
    $db->bind(':temple_id', $temple_id);
    if ($db->execute()) {
        flash_message('Temple deleted successfully.', 'success');
    } else {
        flash_message('Error deleting temple. Please try again.', 'danger');
    }
}

// Fetch all temples
$db->query("SELECT * FROM temples ORDER BY created_at DESC");
$temples = $db->resultSet();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Temples</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Manage Temples</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="admin_posts.php">Manage Posts</a></li>
                <li><a href="admin_temples.php">Manage Temples</a></li>
                <li><a href="admin_artisans.php">Manage Artisans</a></li>
                <li><a href="admin_settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Create/Edit Temple</h2>
        <?php echo flash_message(); ?>
        <form action="admin_temples.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="temple_id" id="temple_id">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="history">History:</label>
                <textarea id="history" name="history"></textarea>
            </div>
            <div>
                <label for="featured_image">Featured Image:</label>
                <input type="file" id="featured_image" name="featured_image">
            </div>
            <div>
                <button type="submit">Save Temple</button>
            </div>
        </form>

        <h2>All Temples</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($temples as $temple): ?>
                    <tr>
                        <td><?php echo $temple['name']; ?></td>
                        <td><?php echo $temple['location']; ?></td>
                        <td>
                            <a href="admin_temples.php?edit=<?php echo $temple['id']; ?>">Edit</a>
                            <a href="admin_temples.php?delete=<?php echo $temple['id']; ?>" onclick="return confirm('Are you sure you want to delete this temple?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script>
        // Populate form for editing
        <?php if (isset($_GET['edit'])): ?>
            var temple = <?php echo json_encode($db->single("SELECT * FROM temples WHERE id = :temple_id", [':temple_id' => clean_input($_GET['edit'])])); ?>;
            document.getElementById('temple_id').value = temple.id;
            document.getElementById('name').value = temple.name;
            document.getElementById('location').value = temple.location;
            document.getElementById('description').value = temple.description;
            document.getElementById('history').value = temple.history;
        <?php endif; ?>
    </script>
</body>
</html>