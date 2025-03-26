
<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo $_POST['name'];
    // exit;
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $subject = clean_input($_POST['subject']);
    $message = clean_input($_POST['message']);

    $db->query("INSERT INTO `contact_messages`(`name`, `email`, `subject`, `message`, `status`, `created_at`) 
    VALUES (:name,:email,:subject,:message,'new',NOW())");
    $db->bind(':name',$name);
    $db->bind(':email',$email);
    $db->bind(':subject',$subject);
    $db->bind(':message',$message);
    if($db->execute()){
        echo true;
        //header('location: ?page=users&status=success');
    } else {
        //header('location: ?page=users&status=error_create');
        echo false;
    }
}
?>