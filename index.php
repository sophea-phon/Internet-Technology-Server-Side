<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'config/database.php';

// Initialize Database Connection
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Discover the rich cultural heritage and treasures of Cambodia" />
    <title>Cambodia Heritage - Explore Temples and Artisans</title>
    <link rel="stylesheet" href="src/styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="index.php">
                   <h4>Cambodia Heritage</h4>
                </a>
            </div>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/pages/temples.php" class="nav-link">Temples</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/pages/artisans.php" class="nav-link">Local Artisans</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/pages/news.php" class="nav-link">News</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/pages/about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="src/pages/contact.php" class="nav-link">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['user_username'])): ?>
                        <li class="nav-item">
                            <a href="src/pages/profile.php" class="nav-link">Welcome, <?php echo $_SESSION['user_username']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="admin/logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="admin/login.php" class="nav-link">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Discover Cambodia's Rich Heritage</h1>
                <p>Explore ancient temples and traditional craftsmanship</p>
                <div class="hero-buttons">
                    <a href="src/pages/temples.php" class="btn btn-primary">Explore Temples</a>
                    <a href="src/pages/artisans.php" class="btn btn-secondary">Meet Artisans</a>
                </div>
            </div>
        </section>

        <!-- Featured Temples Section -->
        <section class="featured-temples">
            <div class="container">
                <h2 class="section-title">Featured Temples</h2>
                <div class="temple-cards">
                    <?php
                    // Fetch temples from the database
                    $db->query("SELECT * FROM temples");
                    $temples = $db->resultSet();

                    if (!empty($temples)) {
                        foreach ($temples as $temple) {
                            echo '<div class="temple-card">
                                    <div class="temple-img">
                                        <img src="' . $temple["featured_image"] . '" alt="' . $temple["name"] . '" />
                                    </div>
                                    <div class="temple-info">
                                        <h3>' . $temple["name"] . '</h3>
                                        <p>' . $temple["description"] . '</p>
                                        <a href="src/pages/temple-details.php?id=' . $temple["id"] . '" class="btn btn-outline">Learn More</a>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo "<p>No temples available.</p>";
                    }
                    ?>
                </div>
                <div class="view-all">
                    <a href="src/pages/temples.php" class="btn btn-primary">View All Temples</a>
                </div>
            </div>
        </section>

        <!-- Featured Artisans Section -->
        <section class="featured-artisans">
            <div class="container">
                <h2 class="section-title">Meet Local Artisans</h2>
                <div class="artisan-cards">
                    <?php
                    // Fetch artisans from the database
                    $db->query("SELECT * FROM artisans");
                    $artisans = $db->resultSet();

                    if (!empty($artisans)) {
                        foreach ($artisans as $artisan) {
                            echo '<div class="artisan-card">
                                    <div class="artisan-img">
                                        <img src="' . $artisan["featured_image"] . '" alt="' . $artisan["name"] . '" />
                                    </div>
                                    <div class="artisan-info">
                                        <h3>' . $artisan["name"] . '</h3>
                                        <p>' . $artisan["bio"] . '</p>
                                        <a href="src/pages/artisan-details.php?id=' . $artisan["id"] . '" class="btn btn-outline">Meet Artisans</a>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo "<p>No artisans available.</p>";
                    }
                    ?>
                </div>
                <div class="view-all">
                    <a href="src/pages/artisans.php" class="btn btn-primary">View All Artisans</a>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials">
            <div class="container">
                <h2 class="section-title">What Visitors Say</h2>
                <div class="testimonial-slider">
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p>"The temples of Cambodia are breathtaking. The guided tour provided insights I would have never discovered on my own."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="assets/images/testimonial1.jpg" alt="Sarah Johnson" />
                            <div>
                                <h4>Sarah Johnson</h4>
                                <p>Tourist from USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p>"Meeting local artisans and learning about silk weaving was the highlight of my trip. Such talented people with amazing stories."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="assets/images/testimonial2.jpg" alt="Mark Thompson" />
                            <div>
                                <h4>Mark Thompson</h4>
                                <p>Cultural Explorer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <div class="container">
                <h2>Subscribe to Our Newsletter</h2>
                <p>Stay updated with the latest news about Cambodia's heritage and cultural events.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required />
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <!-- <img src="assets/images/logo.png" alt="Cambodia Heritage Logo" /> -->
                    <h3>Cambodia Heritage</h3>
                    <p>Exploring and preserving Cambodia's rich cultural heritage.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="src/pages/temples.php">Temples</a></li>
                        <li><a href="src/pages/artisans.php">Local Artisans</a></li>
                        <li><a href="src/pages/about.php">About</a></li>
                        <li><a href="src/pages/contact.php">Contact</a></li>
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

    <script src="src/js/main.js"></script>
</body>
</html>