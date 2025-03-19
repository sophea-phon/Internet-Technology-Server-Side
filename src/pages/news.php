<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';

// Initialize Database Connection
$db = new Database();

// Fetch all news/posts
$db->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $db->resultSet();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Stay updated with the latest news and updates from Cambodia Heritage" />
    <title>News - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
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
                            <a href="post-details.php?id=<?php echo $post['id']; ?>" class="btn btn-outline">Read More</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <!-- <img src="../../assets/images/logo.png" alt="Cambodia Heritage Logo" /> -->
                    <h3>Cambodia Heritage</h3>
                    <p>Exploring and preserving Cambodia's rich cultural heritage.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="temples.php">Temples</a></li>
                        <li><a href="artisans.php">Local Artisans</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Heritage Street, Phnom Penh, Cambodia</p>
                    <p><i class="fas fa-phone"></i> +855 23 456 789</p>
                    <p><i class="fas fa-envelope"></i> info@cambodiaheritage.com</p>
                </div>
                <div class="footer-social">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Cambodia Heritage. All Rights Reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="../js/main.js"></script>
</body>
</html>