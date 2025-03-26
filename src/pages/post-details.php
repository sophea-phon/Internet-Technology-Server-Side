<?php
$post = null;
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $db->query("SELECT * FROM posts WHERE id = $id");
    $post =  $db->single();
}
?>

        <!-- Artisan Details Hero Section -->
        <section class="artisan-details-hero">
            <div class="container">
                <h1><?php echo $post['title']; ?></h1>
                <p>Status: <strong><?php echo $post['status'] ?></strong></p>
            </div>
        </section>
        <!-- Artisan Details Section -->
        <section class="artisan-details">
            <div class="container">
                <div class="artisan-details-content">
                    <div class="artisan-details-text">
                        <h2>About the Post</h2>
                        <p>
                           <?php echo $post['content'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

 