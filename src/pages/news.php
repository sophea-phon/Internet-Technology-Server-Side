<?php
// Fetch all news/posts
$db->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $db->resultSet();
?>

        <!-- News Hero Section -->
        <section class="news-hero">
            <div class="container">
                <h1>Latest News and Updates</h1>
                <p>Stay informed with the latest happenings and updates from Cambodia Heritage</p>
            </div>
        </section>

        <!-- News List Section -->
        <section class="news-list">
            <div class="container">
                <div class="news-cards">
                    <?php foreach ($posts as $post): ?>
                    <div class="news-card">
                        <div class="news-img">
                            <!-- <img src="../../<?php echo $post['featured_image']; ?>" alt="<?php echo $post['title']; ?>" /> -->
                            <!-- Debugging: Output image path -->
                            <!-- <p>Image Path: ../../<?php echo $post['featured_image']; ?></p> -->
                        </div>
                        <div class="news-info">
                            <h3><?php echo $post['title']; ?></h3>
                            <p><?php echo substr($post['content'], 0, 100); ?>...</p>
                            <a href="?page=newdetail&id=<?php echo $post['id']; ?>" class="btn btn-outline">Read More</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
