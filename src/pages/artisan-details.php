<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Detailed information about Cambodia's local artisans and their crafts" />
    <title>Artisan Details - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Artisan Details Hero Section -->
        <section class="artisan-details-hero">
            <div class="container">
                <h1>Artisan Name</h1>
                <p>Location or Specialty</p>
            </div>
        </section>

        <!-- Artisan Details Section -->
        <section class="artisan-details">
            <div class="container">
                <div class="artisan-details-content">
                    <div class="artisan-details-text">
                        <h2>About the Artisan</h2>
                        <p>
                            Detailed information about the artisan, including their
                            background, skills, and the crafts they specialize in.
                        </p>
                        <p>
                            Additional details about their techniques, materials used, and
                            any notable achievements or contributions.
                        </p>
                    </div>
                    <div class="artisan-details-image">
                        <img src="../../assets/images/artisan-detail.jpg" alt="Artisan Image" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery-section">
            <div class="container">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-4.jpg" alt="Gallery Image 1" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-5.jpg" alt="Gallery Image 2" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-6.jpg" alt="Gallery Image 3" />
                    </div>
                    <!-- Add more gallery items as needed -->
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="../../assets/images/logo.png" alt="Cambodia Heritage Logo" />
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