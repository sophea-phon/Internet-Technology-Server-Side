<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Detailed information about Cambodia's ancient temples" />
    <title>Temple Details - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Temple Details Hero Section -->
        <section class="temple-details-hero">
            <div class="container">
                <h1>Temple Name</h1>
                <p>Location of the temple</p>
            </div>
        </section>

        <!-- Temple Details Section -->
        <section class="temple-details">
            <div class="container">
                <div class="temple-details-content">
                    <div class="temple-details-text">
                        <h2>About the Temple</h2>
                        <p>
                            Detailed information about the temple, including its history,
                            architecture, and cultural significance.
                        </p>
                        <p>
                            Additional details about important events, restoration efforts,
                            and any unique characteristics of the temple.
                        </p>
                    </div>
                    <div class="temple-details-image">
                        <img src="../../assets/images/temple-detail.jpg" alt="Temple Image" />
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
                        <img src="../../assets/images/gallery-image-1.jpg" alt="Gallery Image 1" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-2.jpg" alt="Gallery Image 2" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-3.jpg" alt="Gallery Image 3" />
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