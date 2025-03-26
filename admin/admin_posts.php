<?php
// require_once '../config/config.php';
// require_once '../includes/auth.php';
// require_once '../includes/functions.php';
// // Require admin login
// require_admin();

// Handle form submission for creating/updating posts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);
    $status = clean_input($_POST['status']);
    $author_id = $_SESSION['user_id'];

    if (isset($_POST['post_id']) && !empty($_POST['post_id'])) {
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
        header('location: ?page=posts&status=success');
    } else {
        header('location: ?page=posts&status=error_create');
    }
    // header('Location: ?page=posts');
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $post_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM posts WHERE id = :post_id");
    $db->bind(':post_id', $post_id);
    if ($db->execute()) {
        header('location: ?page=posts&status=delete');
    } else {
        header('location: ?page=posts&status=error_delete');
    }
    // header('Location: ?page=posts');
    exit;
}

// Fetch all posts
$db->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $db->resultset();
?>

        <h2>Create/Edit Post</h2>
        <?php include '../includes/status.php' ?>
        <form method="post">
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
                            <a href="?page=posts&edit=<?php echo $post['id']; ?>">Edit</a>
                            <?php if(is_admin()): ?>
                            <a href="?page=posts&delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                                <?php endif; ?>
                        
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
       