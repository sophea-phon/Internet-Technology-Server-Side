<?php
// Fetch all artisans
$db->query("SELECT * FROM artisans ORDER BY name ASC");
$artisans = $db->resultSet();
?>

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
                    <?php 
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
            </div>
        </section>
    