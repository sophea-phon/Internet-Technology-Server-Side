<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require admin login
require_admin();

// Handle form submission for creating/updating users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $role = clean_input($_POST['role']);
    $password = !empty($_POST['password']) ? password_hash(clean_input($_POST['password']), PASSWORD_BCRYPT) : null;

    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        // Update existing user
        $user_id = clean_input($_POST['user_id']);
        if ($password) {
            $db->query("UPDATE users SET username = :username, email = :email, role = :role, password = :password, updated_at = NOW() WHERE id = :user_id");
            $db->bind(':password', $password);
        } else {
            $db->query("UPDATE users SET username = :username, email = :email, role = :role, updated_at = NOW() WHERE id = :user_id");
        }
        $db->bind(':user_id', $user_id);
    } else {
        // Create new user
        $db->query("INSERT INTO users (username, email, role, password, created_at, updated_at) VALUES (:username, :email, :role, :password, NOW(), NOW())");
        $db->bind(':password', $password);
    }

    $db->bind(':username', $username);
    $db->bind(':email', $email);
    $db->bind(':role', $role);

    if ($db->execute()) {
        flash_message('User saved successfully.', 'success');
    } else {
        flash_message('Error saving user. Please try again.', 'danger');
    }
    header('Location: admin_users.php');
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $user_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM users WHERE id = :user_id");
    $db->bind(':user_id', $user_id);
    if ($db->execute()) {
        flash_message('User deleted successfully.', 'success');
    } else {
        flash_message('Error deleting user. Please try again.', 'danger');
    }
    header('Location: admin_users.php');
    exit;
}

// Fetch all users
$db->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $db->resultset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Manage Users</h1>
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
        <h2>Create/Edit User</h2>
        <?php echo flash_message(); ?>
        <form action="admin_users.php" method="post">
            <input type="hidden" name="user_id" id="user_id">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label for="password">Password (leave blank to keep current password):</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="submit">Save User</button>
            </div>
        </form>

        <h2>All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo ucfirst($user['role']); ?></td>
                        <td>
                            <a href="admin_users.php?edit=<?php echo $user['id']; ?>">Edit</a>
                            <a href="admin_users.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script>
        // Populate form for editing
        <?php if (isset($_GET['edit'])): ?>
            var user = <?php echo json_encode($db->single("SELECT * FROM users WHERE id = :user_id", [':user_id' => clean_input($_GET['edit'])])); ?>;
            document.getElementById('user_id').value = user.id;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
        <?php endif; ?>
    </script>
</body>
</html>