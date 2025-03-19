<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';

// Initialize Database Connection
$db = new Database();

// Fetch all artisans
$db->query("SELECT * FROM artisans ORDER BY name ASC");
$artisans = $db->resultSet();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Meet the local artisans of Cambodia and discover their traditional crafts" />
    <title>Local Artisans - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Artisans Hero Section -->
        <section class="artisans-hero">
            <div class="container">
                <h1>Meet Cambodia's Local Artisans</h1>
                <p>Discover the traditional crafts and skilled artisans of Cambodia</p>
            </div>
        </section>

        <!-- Artisans List Section -->
        <section class="artisans-list">
            <div class="container">
                <div class="artisan-cards">
                    <?php foreach ($artisans as $artisan): ?>
                    <div class="artisan-card">
                        <div class="artisan-img">
                            <img src="../../<?php echo $artisan['featured_image']; ?>" alt="<?php echo $artisan['name']; ?>" />
                            <!-- Debugging: Output image path -->
                            <p>Image Path: ../../<?php echo $artisan['featured_image']; ?></p>
                        </div>
                        <div class="artisan-info">
                            <h3><?php echo $artisan['name']; ?></h3>
                            <p><?php echo $artisan['bio']; ?></p>
                            <a href="artisan-details.php?id=<?php echo $artisan['id']; ?>" class="btn btn-outline">Learn More</a>
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