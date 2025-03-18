<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Explore the ancient temples of Cambodia and their rich history"
    />
    <title>Temples - Cambodia Heritage</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header class="header">
      <div class="header-container">
        <div class="logo">
          <a href="../../index.html">
            <img
              src="../../assets/images/logo.png"
              alt="Cambodia Heritage Logo"
            />
          </a>
        </div>
        <nav class="navbar">
          <ul class="nav-menu">
            <li class="nav-item">
              <a href="../../index.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="temples.html" class="nav-link active">Temples</a>
            </li>
            <li class="nav-item">
              <a href="artisans.html" class="nav-link">Local Artisans</a>
            </li>
            <li class="nav-item">
              <a href="about.html" class="nav-link">About</a>
            </li>
            <li class="nav-item">
              <a href="contact.html" class="nav-link">Contact</a>
            </li>
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
      <!-- Temples Hero Section -->
      <section class="temples-hero">
        <div class="container">
          <h1>Explore Cambodia's Ancient Temples</h1>
          <p>
            Discover the rich history and cultural significance of Cambodia's
            most iconic temples
          </p>
        </div>
      </section>

      <!-- Temples List Section -->
      <section class="temples-list">
        <div class="container">
          <div class="temple-cards">
            <div class="temple-card">
              <div class="temple-img">
                <img
                  src="../../assets/images/angkor-wat.jpg"
                  alt="Angkor Wat"
                />
              </div>
              <div class="temple-info">
                <h3>Angkor Wat</h3>
                <p>The iconic symbol of Cambodia, built in the 12th century.</p>
                <a href="temple-details.html?id=1" class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
            <div class="temple-card">
              <div class="temple-img">
                <img src="../../assets/images/bayon.jpg" alt="Bayon Temple" />
              </div>
              <div class="temple-info">
                <h3>Bayon Temple</h3>
                <p>
                  Known for its multitude of serene and smiling stone faces.
                </p>
                <a href="temple-details.html?id=2" class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
            <div class="temple-card">
              <div class="temple-img">
                <img src="../../assets/images/ta-prohm.jpg" alt="Ta Prohm" />
              </div>
              <div class="temple-info">
                <h3>Ta Prohm</h3>
                <p>
                  Famous for the massive tree roots growing out of its ruins.
                </p>
                <a href="temple-details.html?id=3" class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
            <!-- Add more temple cards as needed -->
          </div>
        </div>
      </section>
    </main>

    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-logo">
            <img
              src="../../assets/images/logo.png"
              alt="Cambodia Heritage Logo"
            />
            <p>Exploring and preserving Cambodia's rich cultural heritage.</p>
          </div>
          <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="../../index.html">Home</a></li>
              <li><a href="temples.html">Temples</a></li>
              <li><a href="artisans.html">Local Artisans</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
          <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>
              <i class="fas fa-map-marker-alt"></i> 123 Heritage Street, Phnom
              Penh, Cambodia
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
