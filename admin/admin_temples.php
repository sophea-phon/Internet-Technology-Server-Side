<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require_once '../config/config.php';
// require_once '../includes/auth.php';
// require_once '../includes/functions.php';

// Require admin login
// require_admin();

// Database connection
$db = new Database();
// Handle form submission for creating/updating temples
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name']);
    $location = clean_input($_POST['location']);
    $description = clean_input($_POST['description']);
    $history = clean_input($_POST['history']);
    //$featured_image = !empty($_FILES['featured_image']['name']) ? upload_image($_FILES['featured_image']) : '';
    $featured_image = '';
    if(!empty($_FILES['featured_image']['name'])){
        $featured_image = base64_encode(file_get_contents(addslashes($_FILES['featured_image']['tmp_name'])));
    }
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
        // $temple_last_id = $db->lastInsertId();
        // $db->query("INSERT INTO temple_images (`temple_id`,`image_path`,`caption`,`blob_image`,`created_at`) VALUES (:temple_id,:image_path,:caption,'$image',NOW())");
        // $db->bind(':temple_id',$temple_last_id);
        // $db->bind(':image_path','upload');
        // $db->bind(':caption','Test');
        // if($db->execute()){
        //     header('location: ?page=temples&status=success');
        // }
        header('location: ?page=temples&status=success');
    } else {
        header('location: ?page=temples&status=error_create');
    }
    
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $temple_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM temples WHERE id = :temple_id");
    $db->bind(':temple_id', $temple_id);
    if ($db->execute()) {
        header('location: ?page=temples&status=delete');
    } else {
        header('location: ?page=temples&status=error_delete');
    }
    exit;
}

// Fetch all temples
$db->query("SELECT * FROM temples ORDER BY created_at DESC");
$temples = $db->resultSet();
?>

 
        <h2>Create/Edit Temple</h2>
        <?php include '../includes/status.php';?>
        <form method="post" enctype="multipart/form-data" id="myForm">
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
                <label for="featured_image">Featured Image:</label><p id="size"></p>
                <input type="file" id="featured_image" name="featured_image" accept="image/x-png, image/jpeg" onchange=Filevalidation()>
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
                            <a href="?page=temples&edit=<?php echo $temple['id']; ?>">Edit</a>
                            <?php if(is_admin()):?>
                            <a href="?page=temples&delete=<?php echo $temple['id']; ?>" 
                            onclick="return confirm('Are you sure you want to delete this temple?');">Delete</a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>