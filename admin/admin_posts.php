<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Handle form submission for creating/updating posts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);
    $status = clean_input($_POST['status']);
    $author_id = $_SESSION['user_id'];

    if (isset($_POST['post_id'])) {
        // Update existing post
        $post_id = clean_input($_POST['post_id']);
        $db->query("UPDATE posts SET title = :title, content = :content, status = :status, updated_at = NOW() WHERE id = :post_id");
        $db->bind(':title', $title);
        $db->bind(':content', $content);
        $db->bind(':status', $status);
        $db->bind(':post_id', $post_id);
    } else {
        // Create new post
        $db->query("INSERT INTO posts (title, content, author_id, status, created_at, updated_at) VALUES (:title, :content, :author_id, :status, NOW(), NOW())");
        $db->bind(':title', $title);
        $db->bind(':content', $content);
        $db->bind(':author_id', $author_id);
        $db->bind(':status', $status);
    }

    if ($db->execute()) {
        flash_message('Post saved successfully.', 'success');
    } else {
        flash_message('Error saving post. Please try again.', 'danger');
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $post_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM posts WHERE id = :post_id");
    $db->bind(':post_id', $post_id);
    if ($db->execute()) {
        flash_message('Post deleted successfully.', 'success');
    } else {
        flash_message('Error deleting post. Please try again.', 'danger');
    }
}

// Fetch all posts
$db->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $db->resultset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Manage Posts</h1>
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
        <h2>Create/Edit Post</h2>
        <?php echo flash_message(); ?>
        <form action="admin_posts.php" method="post">
            <input type="hidden" name="post_id" id="post_id">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div>
                <button type="submit">Save Post</button>
            </div>
        </form>

        <h2>All Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo ucfirst($post['status']); ?></td>
                        <td>
                            <a href="admin_posts.php?edit=<?php echo $post['id']; ?>">Edit</a>
                            <a href="admin_posts.php?delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script>
        // Populate form for editing
        <?php if (isset($_GET['edit'])): ?>
            var post = <?php echo json_encode($db->single("SELECT * FROM posts WHERE id = :post_id", [':post_id' => clean_input($_GET['edit'])])); ?>;
            document.getElementById('post_id').value = post.id;
            document.getElementById('title').value = post.title;
            document.getElementById('content').value = post.content;
            document.getElementById('status').value = post.status;
        <?php endif; ?>
    </script>
</body>
</html>