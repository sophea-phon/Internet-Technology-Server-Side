<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Discover the rich cultural heritage and treasures of Cambodia"
    />
    <title>Cambodia Heritage - Explore Temples and Artisans</title>
    <link rel="stylesheet" href="src/styles/main.css" />
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
          <a href="index.html">
            <img src="assets/images/logo.png" alt="Cambodia Heritage Logo" />
          </a>
        </div>
        <nav class="navbar">
          <ul class="nav-menu">
            <li class="nav-item">
              <a href="index.html" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
              <a href="src/pages/temples.html" class="nav-link">Temples</a>
            </li>
            <li class="nav-item">
              <a href="src/pages/artisans.html" class="nav-link"
                >Local Artisans</a
              >
            </li>
            <li class="nav-item">
              <a href="src/pages/about.html" class="nav-link">About</a>
            </li>
            <li class="nav-item">
              <a href="src/pages/contact.html" class="nav-link">Contact</a>
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
      <!-- Hero Section -->
      <section class="hero">
        <div class="hero-content">
          <h1>Discover Cambodia's Rich Heritage</h1>
          <p>Explore ancient temples and traditional craftsmanship</p>
          <div class="hero-buttons">
            <a href="src/pages/temples.html" class="btn btn-primary"
              >Explore Temples</a
            >
            <a href="src/pages/artisans.html" class="btn btn-secondary"
              >Meet Artisans</a
            >
          </div>
        </div>
      </section>

      <!-- Featured Temples Section -->
      <section class="featured-temples">
        <div class="container">
          <h2 class="section-title">Featured Temples</h2>
          <div class="temple-cards">
            <div class="temple-card">
              <div class="temple-img">
                <img src="assets/images/angkor-wat.jpg" alt="Angkor Wat" />
              </div>
              <div class="temple-info">
                <h3>Angkor Wat</h3>
                <p>
                  The iconic symbol of Cambodia, this massive temple complex was
                  built in the 12th century.
                </p>
                <a
                  href="src/pages/temple-details.html?id=1"
                  class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
            <div class="temple-card">
              <div class="temple-img">
                <img src="assets/images/bayon.jpg" alt="Bayon Temple" />
              </div>
              <div class="temple-info">
                <h3>Bayon Temple</h3>
                <p>
                  Known for its multitude of serene and smiling stone faces on
                  the towers.
                </p>
                <a
                  href="src/pages/temple-details.html?id=2"
                  class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
            <div class="temple-card">
              <div class="temple-img">
                <img src="assets/images/ta-prohm.jpg" alt="Ta Prohm" />
              </div>
              <div class="temple-info">
                <h3>Ta Prohm</h3>
                <p>
                  Famous for the massive tree roots growing out of its ruins,
                  creating a magical atmosphere.
                </p>
                <a
                  href="src/pages/temple-details.html?id=3"
                  class="btn btn-outline"
                  >Learn More</a
                >
              </div>
            </div>
          </div>
          <div class="view-all">
            <a href="src/pages/temples.html" class="btn btn-primary"
              >View All Temples</a
            >
          </div>
        </div>
      </section>

      <!-- Featured Artisans Section -->
      <section class="featured-artisans">
        <div class="container">
          <h2 class="section-title">Meet Local Artisans</h2>
          <div class="artisan-cards">
            <div class="artisan-card">
              <div class="artisan-img">
                <img src="assets/images/silk-weaver.jpg" alt="Silk Weaver" />
              </div>
              <div class="artisan-info">
                <h3>Traditional Silk Weaving</h3>
                <p>
                  Discover the ancient art of Cambodian silk weaving passed down
                  through generations.
                </p>
                <a
                  href="src/pages/artisan-details.html?id=1"
                  class="btn btn-outline"
                  >Meet Artisans</a
                >
              </div>
            </div>
            <div class="artisan-card">
              <div class="artisan-img">
                <img src="assets/images/stone-carver.jpg" alt="Stone Carver" />
              </div>
              <div class="artisan-info">
                <h3>Stone Carving</h3>
                <p>
                  Learn about the skilled artisans who keep the traditional
                  Khmer stone carving alive.
                </p>
                <a
                  href="src/pages/artisan-details.html?id=2"
                  class="btn btn-outline"
                  >Meet Artisans</a
                >
              </div>
            </div>
          </div>
          <div class="view-all">
            <a href="src/pages/artisans.html" class="btn btn-primary"
              >View All Artisans</a
            >
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
                <p>
                  "The temples of Cambodia are breathtaking. The guided tour
                  provided insights I would have never discovered on my own."
                </p>
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
                <p>
                  "Meeting local artisans and learning about silk weaving was
                  the highlight of my trip. Such talented people with amazing
                  stories."
                </p>
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
          <p>
            Stay updated with the latest news about Cambodia's heritage and
            cultural events.
          </p>
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
            <img src="assets/images/logo.png" alt="Cambodia Heritage Logo" />
            <p>Exploring and preserving Cambodia's rich cultural heritage.</p>
          </div>
          <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="src/pages/temples.html">Temples</a></li>
              <li><a href="src/pages/artisans.html">Local Artisans</a></li>
              <li><a href="src/pages/about.html">About</a></li>
              <li><a href="src/pages/contact.html">Contact</a></li>
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

    <script src="src/js/main.js"></script>
  </body>
</html>
