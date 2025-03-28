<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require_once '../config/config.php';
// require_once '../includes/auth.php';
// require_once '../includes/functions.php';

// Require admin login
// require_admin();
$db->query("SELECT COUNT(*) AS count FROM users WHERE role='admin'");
$users_count = $db->single()['count'];
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
    try{
        if ($db->execute()) {
            header('location: ?page=users&status=success');
        } else {
            header('location: ?page=users&status=error_create');
        }
    }catch(PDOException $e){
        if ($e->getCode() == 23000) {
            header('location: ?page=users&status=duplicate');
        }else{
            header('location: ?page=users&status=error');
        }
        
    }
    
    //header('Location: admin_users.php');
    exit;
}

// Handle delete request
if (isset($_GET['delete'])) {
    $user_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM users WHERE id = :user_id");
    $db->bind(':user_id', $user_id);
    if ($db->execute()) {
        header('location: ?page=users&status=delete');
    } else {
        header('location: ?page=users&status=error_delete');
    }
    //header('Location: admin_users.php');
    exit;
}

// Fetch all users
try{
    $db->query("SELECT * FROM users ORDER BY created_at DESC");
    $users = $db->resultset();
}catch(PDOException $e){
    echo "error";
}

?>


        <h2>Create/Edit User</h2>
        <?php include '../includes/status.php' ?>
        <form method="post">
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
                    <!-- <option value="user">User</option> -->
                    <option value="editor">Editor</option>
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
                            <a href="?page=users&edit=<?php echo $user['id']; ?>">Edit</a>
                            <?php if ($users_count >= 1  && is_admin() && $_SESSION['user_id'] != $user['id']): ?> 
                                <a href="?page=users&delete=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            <?php endif;?>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
   