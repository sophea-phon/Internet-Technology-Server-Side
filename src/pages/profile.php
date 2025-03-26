<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash(clean_input($_POST['password']), PASSWORD_BCRYPT) : null;
    if(isset($_SESSION['user_id'])){
        $user_id = clean_input($_SESSION['user_id']);
        if ($password) {
            $db->query("UPDATE users SET username = :username, email = :email, password = :password, updated_at = NOW() WHERE id = :user_id");
            $db->bind(':password', $password);
        } else {
            $db->query("UPDATE users SET username = :username, email = :email, updated_at = NOW() WHERE id = :user_id");
        }
        $db->bind(':user_id', $user_id);
    }
    $db->bind(':email', $email);
    $db->bind(':username', $username);
    try{
        if ($db->execute()) {
            $_SESSION['user_username'] = $username;
            $_SESSION['user_email'] = $email;
            header('location: ?page=profile&status=success');
        } else {
            header('location: ?page=profile&status=error_create');
        }
    }catch(PDOException $e){
        echo $e;
        if ($e->errorInfo[1] == 1062) {
            header('location: ?page=profile&status=duplicate');
        }
    }
}
?>
<section class="artisan-details-hero">
    <div class="container user">
        <h1>Profile</h1>
        <?php include 'includes/status.php' ?>
        <form method="post">
            <input type="hidden" name="user_id" id="user_id">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required value="<?php echo $_SESSION['user_username']?>">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $_SESSION['user_email']?>">
            </div>
           
            <div>
                <label for="password">Password (leave blank to keep current password):</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="submit" class="btn btn-secondary">Update</button>
                <a href="admin/index?page=dashboard" target="_blank" class="btn btn-secondary">Manage Page</a>
                <a href="admin/logout.php" class="btn btn-outline">Logout</a>
            </div>
        </form>

    </div>
</section>