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
    <meta name="description" content="Learn about our mission to preserve and promote Cambodia's cultural heritage" />
    <title>About Us - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="about-hero">
            <div class="container">
                <h1>About Cambodia Heritage</h1>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section">
            <div class="container">
                <h2 class="section-title">Our Mission</h2>
                <p>
                    Cambodia Heritage is dedicated to preserving and promoting the rich
                    cultural heritage of Cambodia. We believe in connecting visitors
                    with the authentic experiences, historical treasures, and talented
                    artisans that make Cambodia a unique and special destination.
                </p>
            </div>
        </section>

        <!-- About Content Section -->
        <section>
            <div class="container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>Our Story</h2>
                        <p>
                            Founded in 2020, Cambodia Heritage began as a small group of
                            passionate historians, archaeologists, and cultural enthusiasts
                            who wanted to share the beauty and significance of Cambodia's
                            cultural treasures with the world.
                        </p>
                        <p>
                            What started as a simple blog has grown into a comprehensive
                            resource for travelers, researchers, and anyone interested in
                            learning about Cambodia's rich heritage. We work closely with
                            local communities, artisans, and conservation organizations to
                            ensure that our information is accurate, respectful, and
                            supportive of sustainable tourism.
                        </p>
                        <p>
                            Our team has expanded to include local guides, cultural experts,
                            and digital specialists who are all united by a shared love for
                            Cambodia's history and traditions.
                        </p>
                    </div>
                    <div class="about-image">
                        <img src="../../assets/images/about-team.jpg" alt="Cambodia Heritage Team" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="container">
                <h2 class="section-title">Meet Our Team</h2>
                <div class="team-members">
                    <div class="team-member">
                        <div class="team-member-img">
                            <img src="../../assets/images/team-member-1.jpg" alt="Sophea Kem" />
                        </div>
                        <div class="team-member-info">
                            <h3>Sophea Kem</h3>
                            <p>Founder & Cultural Director</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="team-member-img">
                            <img src="../../assets/images/team-member-2.jpg" alt="David Chen" />
                        </div>
                        <div class="team-member-info">
                            <h3>David Chen</h3>
                            <p>Head of Research</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="team-member-img">
                            <img src="../../assets/images/team-member-3.jpg" alt="Lina Morn" />
                        </div>
                        <div class="team-member-info">
                            <h3>Lina Morn</h3>
                            <p>Artisan Relations</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="team-member-img">
                            <img src="../../assets/images/team-member-4.jpg" alt="Michael Lee" />
                        </div>
                        <div class="team-member-info">
                            <h3>Michael Lee</h3>
                            <p>Temple Conservation Specialist</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
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