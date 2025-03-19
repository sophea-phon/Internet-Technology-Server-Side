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
    <meta name="description" content="Contact Cambodia Heritage for information about temples, artisans, or tours" />
    <title>Contact Us - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Contact Hero Section -->
        <section class="contact-hero">
            <div class="container">
                <h1>Contact Us</h1>
                <p>Have questions or need more information? We're here to help!</p>
            </div>
        </section>

        <!-- Contact Information -->
        <section class="contact-info-section">
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Visit Us</h3>
                        <p>123 Heritage Street<br />Phnom Penh, Cambodia</p>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p class="contact-email">info@heritage.com<br />support@heritage.com</p>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>+855 23 456 789<br />+855 23 987 654</p>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Opening Hours</h3>
                        <p>
                            Monday - Friday: 9:00 AM - 5:00 PM<br />Saturday: 10:00 AM -
                            2:00 PM
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-form-section">
            <div class="container">
                <div class="contact-content">
                    <div class="contact-text">
                        <h2>Get In Touch</h2>
                        <p>
                            Whether you have questions about our content, want to suggest a
                            new feature, or are interested in partnering with us, we'd love
                            to hear from you!
                        </p>
                        <p>
                            Our team typically responds within 24-48 hours during business
                            days.
                        </p>
                        <div class="contact-social">
                            <h3>Connect With Us</h3>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <form class="contact-form">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" required />
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required />
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.8380963193434!2d104.91320931480864!3d11.558035091794988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513c9b5aa37d%3A0x58cf9d85b5d2f178!2sPhnom%20Penh%2C%20Cambodia!5e0!3m2!1sen!2sus!4v1614569425267!5m2!1sen!2sus"
                    allowfullscreen=""
                    loading="lazy"
                ></iframe>
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
                    <p>
                        <i class="fas fa-map-marker-alt"></i> 123 Heritage Street, Phnom Penh, Cambodia
                    </p>
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