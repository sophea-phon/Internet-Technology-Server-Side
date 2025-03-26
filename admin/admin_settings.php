<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require_once '../config/config.php';
// require_once '../includes/auth.php';
// require_once '../includes/functions.php';

// Require admin login
//require_admin();
// Fetch current settings

$site_name = get_setting('site_name');
$contact_email = get_setting('contact_email');
$footer_text = get_setting('footer_text');
// Handle form submission for updating settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = clean_input($_POST['site_name']);
    $c = clean_input($_POST['contact_email']);
    $f = clean_input($_POST['footer_text']);
    if($site_name =='' && $contact_email ==''  && $footer_text ==''){
        
        create_setting('site_name',$s);
        create_setting('contact_email',$c);
        create_setting('footer_text',$f);
        flash_message('Settings updated successfully.', 'success');
    }else{
        
        
        // Update settings in the database
        update_setting('site_name', $s);
        update_setting('contact_email', $c);
        update_setting('footer_text', $f);
        flash_message('Settings updated successfully.', 'success');
    }
    

    
}

$site_name = get_setting('site_name');
$contact_email = get_setting('contact_email');
$footer_text = get_setting('footer_text');
?>

        <h2>Update Settings</h2>
        <?php echo flash_message(); ?>
        <form method="post">
            <div>
                <label for="site_name">Site Name:</label>
                <input type="text" id="site_name" name="site_name" value="<?php echo $site_name; ?>" required>
            </div>
            <div>
                <label for="contact_email">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" value="<?php echo $contact_email; ?>" required>
            </div>
            <div>
                <label for="footer_text">Footer Text:</label>
                <textarea id="footer_text" name="footer_text" required><?php echo $footer_text; ?></textarea>
            </div>
            <div>
                <button type="submit">Update Settings</button>
            </div>
        </form>
    </main>
</body>
</html>