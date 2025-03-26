<?php

if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
    $message_id = clean_input($_GET["edit"]);
    $db->query("UPDATE contact_messages SET status = 'read', updated_at = NOW() WHERE id = $message_id");
    $db->execute();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $message_id = clean_input($_GET['delete']);
    $db->query("DELETE FROM contact_messages WHERE id = :message_id");
    $db->bind(':message_id', $message_id);
    if ($db->execute()) {
        header('location: ?page=messages&status=delete');
    } else {
        header('location: ?page=messages&status=error_delete');
    }
    //header('Location: admin_users.php');
    exit;
}

$db->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
$messages = $db->resultSet();
?>


        <h2>Messages</h2>
        <form>
            <input type="hidden" name="message_id" id="message_id">
            <div>
                <label for="username">Name:</label>
                <input type="text" id="name" name="name" disabled>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" disabled>
            </div>
            <div>
                <label for="email">Subject:</label>
                <input type="text" id="subject" name="subject" disabled>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" disabled></textarea>
            </div>
            <div>
                <button type="button" onclick="myFunction()">Clear</button>
            </div>
        </form>

        <h2>All Message</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?php echo $message['name']; ?></td>
                        <td><?php echo $message['email']; ?></td>
                        <td><?php echo $message['subject'] ?></td>
                        <td><?php echo $message['status'] ?></td>
                        <td>
                            <a href="?page=messages&edit=<?php echo $message['id']; ?>">Read</a>
                            <a href="?page=messages&delete=<?php echo $message['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script type="text/javascript">
            // document.getElementById('clear').addEventListener("click",myFunction)
            function myFunction(){
                document.getElementById('message_id').value = '';
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('subject').value = '';
                document.getElementById('message').value = '';
            }

        </script>