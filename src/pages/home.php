 <!-- Hero Section -->
 <section class="hero">
            <div class="hero-content">
                <h1>Discover Cambodia's Rich Heritage</h1>
                <p>Explore ancient temples and traditional craftsmanship</p>
                <div class="hero-buttons">
                    <a href="?page=temples" class="btn btn-primary">Explore Temples</a>
                    <a href="?page=artisans" class="btn btn-secondary">Meet Artisans</a>
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
                    $db->query("SELECT * FROM temples ORDER BY RAND( ) LIMIT 3");
                    $temples = $db->resultSet();
                    if (!empty($temples)) {
                        foreach ($temples as $temple) {
                            $defaultImage = 'src="assets/default_image.png"';
                            if($temple["featured_image"] != null || $temple["featured_image"] != ''){
                                $defaultImage = 'src=data:image;base64,' . $temple["featured_image"];
                            }
                            echo '<div class="temple-card">
                                    <div class="temple-img">
                                        <img ' .$defaultImage . ' alt="' . $temple["name"] . '" />
                                    </div>
                                    <div class="temple-info">
                                        <h3>' . $temple["name"] . '</h3>
                                        <p class="three-lines-text">' . $temple["description"] . '</p>
                                        <a href="?page=templedetail&id=' . $temple["id"] . '" class="btn btn-outline">Learn More</a>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo "<p>No temples available.</p>";
                    }
                    ?>
                </div>
                <div class="view-all">
                    <a href="?page=temples" class="btn btn-primary">View All Temples</a>
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
                    $db->query("SELECT * FROM artisans ORDER BY RAND( ) LIMIT 3");
                    $artisans = $db->resultSet();

                    if (!empty($artisans)) {
                        foreach ($artisans as $artisan) {
                            $defaultImage = 'src="assets/default_image.png"';
                            if($artisan["featured_image"] != null || $artisan["featured_image"] != ''){
                                $defaultImage = 'src=data:image;base64,' . $artisan["featured_image"];
                            }
                            echo '<div class="artisan-card">
                                    <div class="artisan-img">
                                        <img '.$defaultImage.' alt="' . $artisan["name"] . '" />
                                    </div>
                                    <div class="artisan-info">
                                        <h3>' . $artisan["name"] . '</h3>
                                        <p class="three-lines-text">' . $artisan["bio"] . '</p>
                                        <a href="?page=artisandetail&id=' . $artisan["id"] . '" class="btn btn-outline">Meet Artisans</a>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo "<p>No artisans available.</p>";
                    }
                    ?>
                </div>
                <div class="view-all">
                    <a href="?page=artisans" class="btn btn-primary">View All Artisans</a>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <!-- <section class="testimonials">
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
        </section> -->

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